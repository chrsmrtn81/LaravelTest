<?php

namespace App\Http\Controllers\RssFeeds;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProcessRssFeeds extends Controller
{    
    protected $most_recent_article_dates = [];
    
    protected $xml_feeds;

    /**
     * Constructs $this->most_recent_article_dates array and sets $this->xml_feeds.
     */
    public function __construct()
    {
        $this->xml_feeds = DB::table('sources')
        ->get()
        ->toArray();
        
        $sources = DB::table('articles')
        ->distinct()
        ->get('source_id');

        foreach($sources as $source){
            $mostRecentArticle = DB::table('articles')
            ->select(DB::raw('max(pub_date) as pub_date'))
            ->from('articles')
            ->whereRaw('source_id = "'. $source->source_id .'"')
            ->get();

            $this->most_recent_article_dates[$source->source_id] = $mostRecentArticle[0]->pub_date;
        }
    }
    
    /**
     * Fetch and save RSS feeds from xmlFeedSettings.json.
     */
    public function fetchRssFeeds()
    {
        foreach($this->xml_feeds as $xml_feed){
            $xml_data = $this->fetchFeed($xml_feed);
            $articles = $this->checkArticleDates($xml_data, $xml_feed);
            $this->saveArticles($articles);
        }
    }

    /**
     * Fetches an RSS feed and returns it as a simplexml object.
     */
    private function fetchFeed($xml_feed)
    {
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch,CURLOPT_URL, $xml_feed->url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13');
            $xml_data = curl_exec($ch);
            curl_close($ch);

            return simplexml_load_string($xml_data);
    }

    /**
     * Check which articles are newer than the most recent article to ensure duplicate articles aren't saved.
     */
    private function checkArticleDates($xml_data, $xml_feed)
    {
        $articles = [];

        // foreach($xml_data->channel->item as $item){
        //     var_dump();
        // }

        foreach($xml_data->channel->item as $article) {
            $article_date = str_replace('/', '-', (string) $article->pubDate);
            $article_date = str_replace(' - ', ' ', (string) $article->pubDate);
            $article_date = strtotime($article_date);
            $article_date = Carbon::createFromTimestamp($article_date)->format('Y-m-d H:i:s');

            $most_recent_article_date = 0;

            if(isset($this->most_recent_article_dates[$xml_feed->id])){
                $most_recent_article_date = $this->most_recent_article_dates[$xml_feed->id];
            }

            if($article_date > $most_recent_article_date){
                $image = null;
                $content = null;
                $categories = [];

                foreach($article->children("content", true) as $k => $v){
                    if ($k == 'encoded') {
                        $content = (string) $v;
                    }
                }

                foreach ($article->children('media', true) as $k => $v) {
                    $attributes = $v->attributes();
                    
                    if ($k == 'content') {
                        if (property_exists($attributes, 'url')) {
                            $image = (string) $attributes->url;
                        }
                    }
                }

                foreach ((array) $article->category as $category){
                    $categories[] = (string) $category;
                }

                $articles[] = [
                    'source_name' => $xml_feed->nice_name,
                    'source_id' => $xml_feed->id,
                    'title' => (string) $article->title,
                    'slug' => Str::slug((string) $article->title, '-'),
                    'description' => Str::limit(html_entity_decode(strip_tags(trim((string)$article->description))), 200, $end='...'),
                    'content' => $content,
                    'link' => (string) $article->link,
                    'pub_date' => $article_date,
                    'image' => $image,
                    'categories' => $categories,
                ];
            }
        }

        return $articles;
    }

    /**
     * Save articles
     */
    private function saveArticles($articles)
    {
        foreach($articles as $article){
            $a = new Article;
            
            $a->source_name = $article['source_name'];
            $a->source_id = $article['source_id'];
            $a->title = $article['title'];
            $a->slug = $article['slug'];
            $a->description = $article['description'];
            $a->content = $article['content'];
            $a->link = $article['link'];
            $a->pub_date = $article['pub_date'];
            $a->categories = implode(',', $article['categories']);
            $a->image = $article['image'];
            $a->active = 1;

            $a->save();
        }
    }
}

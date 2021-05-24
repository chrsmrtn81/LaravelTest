<?php
namespace App\Http\Controllers\Views;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Home extends Controller
{
    public function index(Request $request)
    {
        $selectedSourceFilters = $request->cookie('selectedSourceFilters');

        if($selectedSourceFilters){
            $articles = DB::table('articles')
                ->where('active', 1)
                ->whereIn('source_id', json_decode($selectedSourceFilters))
                // ->skip($request->input('offset'))
                ->take(10)
                ->orderBy('pub_date', 'DESC')
                ->get();
        } else {
            $articles = DB::table('articles')
                ->where('active', 1)
                ->orderBy('pub_date', 'DESC')
                // ->skip($request->input('offset'))
                ->take(10)
                ->get();
        }

        $sources = DB::table('sources')
            ->where('active', 1)
            ->orderBy('nice_name', 'ASC')
            ->get(['id', 'name', 'nice_name']);

        $articles = $this->sanitiseArticles($articles);
        $sources = $this->selectedSources($sources, $selectedSourceFilters);

        $data = [
            'articles' => $articles,
            'sources' => $sources,
        ];

        return response()
            ->view('home', $data, 200);
            //->withCookie(cookie()->forever('selectedSourceFilters', 'these will be source ids'));
    }

    public function sanitiseArticles($articles)
    {
        foreach ($articles as $article){
            $article->pub_date = Carbon::parse($article->pub_date)->diffForHumans();
        }

        return $articles;
    }

    public function updateCookies(Request $request)
    {
        $articles = DB::table('articles')
            ->where('active', 1)
            ->whereIn('source_id', json_decode($request->input('ids')))
            ->orderBy('pub_date', 'DESC')
            // ->skip($request->input('offset'))
            ->take(10)
            ->get();

        $articles = $this->sanitiseArticles($articles);
        
        return response($articles)
            ->cookie('selectedSourceFilters', $request->input('ids'), 500);
    }

    private function selectedSources($sources, $selectedSourceFilters)
    {
        if($selectedSourceFilters){
            foreach($sources as $source){
                if (in_array($source->id, json_decode($selectedSourceFilters))){
                    $source->checked = true;
                } else {
                    $source->checked = false;
                }
            }
        } else {
            foreach($sources as $source){
                $source->checked = true;
            }
        }

        return $sources;
    }

    public function addArticleView(Request $request){
        $update = DB::table('articles')
            ->whereId($request->input('id'))
            ->increment('views');
        
        return $update;
    }

    public function fetchMoreArticles(Request $request){
        $articles = DB::table('articles')
            ->where('active', 1)
            ->orderBy('pub_date', 'DESC')
            ->skip($request->input('offset'))
            ->take(10)
            ->get();
        
        $articles = $this->sanitiseArticles($articles);
        
        return response($articles);
    }
}

<?php
namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Home extends Controller
{
    public function index(Request $request)
    {
        $selectedSourceFilters = $request->cookie('selectedSourceFilters');
        
        $articles = DB::table('articles')
        ->where('active', 1)
        ->whereIn('source_id', json_decode($selectedSourceFilters))
        ->orderBy('pub_date', 'DESC')
        ->get();

        $sources = DB::table('sources')
        ->where('active', 1)
        ->orderBy('nice_name', 'ASC')
        ->get(['id', 'name', 'nice_name']);

        $sources = $this->selectedSources($sources, $selectedSourceFilters);
            
        $data = [
            'articles' => $articles,
            'sources' => $sources,
        ];

        return response()
            ->view('home', $data, 200);
            //->withCookie(cookie()->forever('selectedSourceFilters', 'these will be source ids'));
    }

    public function post(Request $request)
    {
        $articles = DB::table('articles')
        ->where('active', 1)
        ->whereIn('source_id', $request->input('values'))
        ->orderBy('pub_date', 'DESC')
        ->get();

        return [
            'request' => $articles,
            'test' => 'this is a test',
        ];
    }

    public function sources()
    {
        $sources = DB::table('sources')
        ->where('active', 1)
        ->orderBy('nice_name', 'ASC')
        ->get(['id', 'name', 'nice_name']);

        return $sources;
    }

    public function updateCookies(Request $request)
    {
        return response('updateCookies')
            ->cookie('selectedSourceFilters', $request->input('values'), 500);
    }

    private function selectedSources($sources, $selectedSourceFilters)
    {
        foreach($sources as $source){
            if (in_array($source->id, json_decode($selectedSourceFilters))){
                $source->checked = true;
            } else {
                $source->checked = false;
            }
        }

        return $sources;
    }
}

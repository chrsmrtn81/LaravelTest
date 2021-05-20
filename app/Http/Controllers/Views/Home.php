<?php
namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Home extends Controller
{
    public function index(Request $request)
    {
        $articles = DB::table('articles')
        ->where('active', 1)
        ->orderBy('pub_date', 'DESC')
        ->get();

        $sources = DB::table('sources')
        ->where('active', 1)
        ->orderBy('nice_name', 'ASC')
        ->get(['id', 'name', 'nice_name']);

        return view('home', [
            'articles' => $articles,
            'sources' => $sources,
            'request' => $request->input('values'),
        ]);
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
}

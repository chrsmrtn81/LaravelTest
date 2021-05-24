<?php
namespace App\Http\Controllers\Views;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Test extends Controller
{
    public function index(Request $request)
    {
        $data = [

        ];

        return response()
            ->view('test', $data, 200);
    }

    public function fetchArticles(Request $request)
    {

        
        $articles = DB::table('articles')
            ->where('active', 1)
            ->orderBy('pub_date', 'DESC')
            ->skip($request->input('offset'))
            ->take(10)
            ->get();
        
        return response($articles);
    }
}

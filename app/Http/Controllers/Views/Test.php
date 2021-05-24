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
}

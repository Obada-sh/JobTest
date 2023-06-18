<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowNonPublishedPostsController extends Controller
{
    public function show()
    {
        $posts = DB::table('posts')->where('Is_published','=',false)->get();

        return response()->json(
            [
                'status' => true,
                'data' => $posts
            ]
        ,201 );
    }
}

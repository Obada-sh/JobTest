<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function post(PostRequest $request)
    {
        $post = Post::create([
            'title'=>$request['title'],
            'user_id'=>Auth::user()->id,
            'content'=>$request['content'],

        ]);


        return response()->json(
            [
                'message' => "post created successfully",
                'status' => true,
                'data' => $post,
            ]
        ,201 );
    }


public function show(Request $request)
{
    $filter = $request->query('filter');

    if ($filter === 'me') {

        $userId = Auth::id();
        $posts = Post::where('user_id', $userId)->get();
    } else {

        $posts = Post::all();
    }

    $postsArray = $posts->toArray();

    return $postsArray;
}
}

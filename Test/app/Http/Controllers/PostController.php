<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function post(PostRequest $request)
    {
        $post = Post::create([
            'title'=>$request['title'],
            'content'=>$request['content'],
        ]);


        return response()->json(
            [
                'message' => "post created successfully",
                'status' => true,
                'data' => $post
            ]
        ,201 );
    }
}

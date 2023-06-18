<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsConfirmation extends Controller
{
    public function allaw($post_id)
    {
        $post = DB::table('posts')->where('id','=',$post_id)->update([
            'Is_published' => true,
        ]);

        return response()->json(
            [
                'status' => true,
                'message' => 'updated successfully'
            ]
        ,201 );
    }

    public function disallaw($post_id)
    {
        $post = DB::table('posts')->where('id','=',$post_id)->delete();

        return response()->json(
            [
                'status' => true,
                'message' => 'deleted successfully'
            ]
        ,201 );
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class NewController extends Controller
{
    public function index()
    {

        $posts = Post::where('status', 2)->get();
        return view('allpost.list', compact('posts'));

    }

    public function show($slug, Post $post)
{

    $post = Post::where('slug', $slug)->where('status', 2)->first();
    return view('user.show', compact('post'));
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $data = [
            'items' => ['Bài viết 1', 'Bài viết 2', 'Bài viết 3'],
        ];

        return view('posts.index', $data);
    }
}

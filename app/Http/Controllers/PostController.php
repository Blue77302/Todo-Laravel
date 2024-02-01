<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::id()){
            $role=Auth()->user()->role;

            if($role=='user'){
                return view ('dashboard');
            }

            else if($role=='admin'){
                $data = Post::orderBy('created_at','desc')->paginate(10);
                $user = Auth()->user();
                return view ('admin.post', compact ('data','user'));
            }

            else {
                return redirect()->back();
            }
        }
        // return view ('post');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('news.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $post = Post::create([
            'thumbnail' => $request->thumbnail,
            'title' => $request->title,
            'description' => $request->description,
            'publish_date' => $request->publish_date,
            'status' => $request->status,
            'user_id' => Auth::id()
        ]);



        return to_route('post.index')->with('message', ' Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return view('admin.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        return view('admin.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        $input = $request->all();
        $post->update($input);
        return to_route('post.index')->with('message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('post.index')->with('message','Delete success');
    }

    //Xoá tất cả
    public function deletePostsByUser(User $user)
    {
    if (!$user) {
        return redirect()->route('post.index')->with('message', 'User not found');
    }

    $user->posts()->delete();

    return redirect()->route('post.index')->with('message', 'Delete success');
    }

    //Lấy danh sách của user
    public function getPostsByUser($user)
{
    // Lấy tất cả bài viết của user thông qua mối quan hệ
    $posts = $user->posts;

    return view('posts.index', compact('posts'));
}

}

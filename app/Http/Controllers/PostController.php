<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
// use Spatie\MediaLibrary\MediaCollections\MediaRepository;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $user = Auth()->user();

        $user = Auth::user();

        $data = Post::with('user')->where('user_id', $user->id)->orderBy('created_at','desc')->paginate(3);

        return view('user.post', compact('data', 'user'));
    }

    public function create()
    {
        return view ('user.create');
    }

    public function store(PostRequest $request)
    {

        $post = Post::create([
            'thumbnail' => $request->thumbnail,
            'title' => $request->title,
            'content' => $request->content,
            'slug' => $request->slug,
            'description' => $request->description,
            'publish_date' => $request->publish_date,
            'user_id' => Auth::id()
        ]);

        $post->addMediaFromRequest('thumbnail')
            ->usingName($post->id)
            ->toMediaCollection();

        return to_route('post.index')->with('message', ' Create a successful article!');
    }


    public function show(Post $post)
    {
        return view('user.show')->with('post', $post);
    }

    public function edit(Post $post)
    {
        if(Auth::id() === $post->user_id)
        {
        return view('user.edit')->with('post', $post);
        }
        return abort('404');
    }

    public function update(Post $post, PostRequest $request)
    {
        $post->update(request()->all());
        return to_route('post.index')->with('message', 'Updated success!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('post.index')->with('message','Delete success');
    }

    public function deletePostsByUser(User $user)
    {
    if (!$user) {
        return redirect()->route('post.index')->with('message', 'User not found');
    }

    $user->posts()->delete();

    return redirect()->route('post.index')->with('message', 'Delete success');
    }

    public function getPostsByUser($user)
{
    $posts = $user->posts;

    return view('posts.index', compact('posts'));
}

}

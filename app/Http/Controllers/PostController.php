<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PostCreateRequest;
use Illuminate\Support\Str;
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

        return view('admin.post', compact('data', 'user'));


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
    public function store(PostCreateRequest $request)
    {

        $data = $request->validated();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(),[
                'title' => ['required'|'max:30'],
                'content' => ['required'|'max:300'],
                // 'description' => ['max:300'],
                // 'slug' => ['required', 'string', 'max:300', 'alpha' ],
                // 'thumbnail' => ['required', 'file'],
            ]);
        }

        $post = Post::create([
            'thumbnail' => $request->thumbnail,
            'title' => $request->title,
            'content' => $request->content,
            'slug' => $request->slug,
            'description' => $request->description,
            'publish_date' => $request->publish_date,
            'user_id' => Auth::id()
        ]);

        // Xử lý thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $thumbnailPath;
        }
        // if ($request->hasFile('thumbnail')) {
        //     $post->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
        // }

        // Tạo slug từ title
        // $slug = str::slug($data['title']);
        // // Kiểm tra xem slug đã tồn tại chưa, nếu có thì thêm số đằng sau
        // $count = 1;

        // while (Post::where('slug', $slug)->exists()) {
        //     $slug = str::slug($data['title']) . '-' . $count;
        //     $count++;
        // }

        // $data['slug'] = $slug;
        // $user_id = auth()->id(); // Lấy id của người dùng đang đăng nhập
        // $data['user_id'] = $user_id;


        // Post::create($data);

        // Post::saving(function ($model) {
        //     $model->slug = Str::slug($model->title);
        //     $model->slug = Post::makeUniqueSlug($model->slug, $model->id);
        // });
        return to_route('post.index')->with('message', ' Create a successful article!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        // $media = $mediaRepository->getCollection($post, 'thumbnail');
        return view('admin.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if(Auth::id() ===$post->user_id)
        {
        return view('admin.edit')->with('post', $post);

        }
        return abort('404');
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

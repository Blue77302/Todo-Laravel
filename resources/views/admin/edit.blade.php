@extends('admin.layout')
@section('content')
@session('message')
<div class="alert alert-success text-center">{{ session('error') }}</div>
@endsession

<form action="{{ route('post.update', ['post' => $post->id]) }}" method="post">
    @csrf
    @method('PUT')
    <div class="card-body">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}" placeholder="tỉtle">
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" name="description" class="form-control" id="description" value="{{$post->description}}" placeholder="Description">
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
      </div>
      <div class="form-group">
        <label for="exampleThumbnail">Thumbnail</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" name="thumbnail" id="exampleInputFile" value="{{$post->thumbnail}}">
          </div>
        </div>
        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <textarea type="text" name="content"  id="editor" value="{{$post->content}}" ></textarea>
        <x-input-error :messages="$errors->get('content')" class="mt-2" />
      </div>

    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">
        Edit articles</button>
    </div>
  </form>


 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

@endsection('content')

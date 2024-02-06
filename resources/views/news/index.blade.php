@extends('admin.layout')
@section('content')

<form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" placeholder="tỉtle">
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" name="description" class="form-control" id="description" value="{{old('description')}}" placeholder="Description">
        {{-- <x-input-error :messages="$errors->get('description')" class="mt-2" /> --}}
      </div>
      <div class="form-group">
        <label for="exampleThumbnail">Thumbnail</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" name="thumbnail" id="exampleInputFile"  value="{{old('thumbnail')}}">
          </div>
        </div>
        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <textarea type="text" name="content"  id="editor" ></textarea>
        <x-input-error :messages="$errors->get('content')" class="mt-2" />
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Create articles</button>
    </div>
  </form>


@endsection('content')

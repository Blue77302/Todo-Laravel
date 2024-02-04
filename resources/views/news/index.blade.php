@extends('admin.layout')
@section('content')

<form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <div class="card-body">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" placeholder="tỉtle">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" name="description" class="form-control" id="description" value="{{old('description')}}" placeholder="Description">
      </div>
      <div class="form-group">
        <label for="exampleThumbnail">Thumbnail</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" name="thumbnail" class="custom-file-input" id="exampleInputFile">
            <label class="custom-file-label" for="exampleThumbnail">Choose file</label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <textarea type="text" name="content"  id="editor" ></textarea>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">reate articles</button>
    </div>
  </form>


@endsection('content')

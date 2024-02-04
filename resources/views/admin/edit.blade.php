@extends('admin.layout')
@section('content')

<form action="{{ route('post.store') }}" method="post">
    {!! csrf_field() !!}
    <div class="card-body">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}" placeholder="tỉtle">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" name="description" class="form-control" id="description" value="{{$post->description}}" placeholder="Description">
      </div>
      <div class="form-group">
        <label for="thumbnail">Thumbnail</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="exampleInputFile">
            <label class="custom-file-label" for="exampleThumbnail">Choose file</label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <textarea type="text" name="content"  id="editor" value="{{$post->content}}" ></textarea>
      </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">
        Edit articles</button>
    </div>
  </form>


 <!-- Include the Summernote script -->
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

 <!-- Initialize Summernote -->
 <script>
     $(document).ready(function() {
         $('#content').summernote();
     });
 </script>

@endsection('content')

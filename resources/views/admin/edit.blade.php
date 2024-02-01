@section('admin.layout')
@section('content')

<div class="card" style="margin: 20px">
    <div class="card-header">Edit </div>
    <div class="card-body">

        <form action="{{ route('post.update', ['post'=>$post]) }}" method="put">
            {!! csrf_field() !!}
            <label >Thumbnail</label></br>
            <input type="text" name="thumbnail" id="thumbnail" class="form-control"></br>
            <label >Title</label></br>
            <input type="text" name="title" id="title" class="form-control"></br>
            <label >Description</label></br>
            <input type="text" name="description" id="description" class="form-control"></br>
            <label >Status</label></br>
            <input type="text" name="status" id="status" class="form-control"></br>
            <input type="submit" value="save" class="btn btn-success"></br>
        </form>
    </div>

</div>

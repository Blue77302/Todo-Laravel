@extends('layouts.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">

                <a href="{{ route('post.create') }}" class="btn btn-success btn-sm" title="Add new">
                    Add New
                </a>

                <form action="{{ route('delete-posts-by-user', ['user' => $user]) }}" method="post" accept="UTF-8" style="display:inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" title="delete" onclick="return confirm(&quot;Confirm delete?&quot;)">
                        <i class="fa fa-trash" aria-hidden="true"> Delete All </i>
                    </button>
                </form>


              </div>
              <!-- /.card-header -->
              {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
              @session('message')
              <div class="alert alert-success text-center">{{ session('message') }}</div>
              @endsession
              <div class="card-body">
                <table id="posts" class="table table-bordered table-striped">
                <thead>
                <tbody>
                  <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Publish_date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($data as $item)
                  <tr>
                    <td><img class="card-img-top" src="{{$item->getFirstMediaUrl()}}" style="width:186px; height:80px;" alt="Thumbnail"></td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->publish_date }}</td>
                    <td>{!!
                        $item->status==0? '<button class="btn btn-danger btn-sm">Bài viết mới</button>':
                        ($item->status == 1 ? '<button class="btn btn-success btn-sm">Được cập nhật</button>' :
                                            '<button class="btn btn-primary btn-sm">Được phê duyệt</button>')
                    !!}</td>
                    <td ><a href="{{ route('post.edit', ['post' => $item]) }}" title="Edit">
                        <button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true">
                            Edit
                        </i></button></a><br>

                        <a href="{{ route('post.show', ['post' => $item]) }}" title="Show">
                        <button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true">
                            Show
                        </i></button></a><br>

                        <form action="{{ route('post.destroy', ['post' => $item]) }}" method="post"  accept="UTF-8" style="display:inline" >
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" title="delete"
                            onclick="return confirm(&quot;Confirm delete?&quot;)" ><i class="fa fa-trash" aria-hidden="true">
                                Delete
                            </i></button>
                        </form>
                    </td>
                  </tr>
                @endforeach
                </tbody>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-end">
        {{$data->links()}}
      </div>
    </section>
  </div>

@endsection

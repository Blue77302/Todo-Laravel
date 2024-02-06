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


              </div>
              <div class="card-body">
                <table id="posts" class="table table-bordered table-striped">
                <tbody>
                    <div class="container">
                        <div class="row">
                          @foreach ($posts as $item)
                            <div class="col-md-4">
                              <div class="card mb-4">
                                <img class="card-img-top" src="{{$item->getFirstMediaUrl()}}" style="width:286px; height:180px;" alt="Thumbnail">
                                <div class="card-body">
                                  <a href="{{ route('news.show', $item->slug) }}"><h5 class="card-title">{{ $item->title }}</h5></a>
                                  <p class="card-text">{{ $item->description }}</p>
                                  <p class="card-text"><small class="text-muted">{{ $item->publish_date }}</small></p>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      </div>
                </tbody>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-end">
      </div>
    </section>
  </div>
</div>
@endsection

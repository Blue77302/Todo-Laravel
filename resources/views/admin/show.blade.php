@extends('admin.layout')
@section('content')


<div class="card">
  <div class="card-header">Post Page</div>
  <div class="card-body">


        <div class="card-body">
        <h5 class="card-title">{{ $post->thumbnail}}</h5>
        <img src="{{$post->getFirstMediaUrl()}}" style="width:90px; height:90px;" alt="">
        <h5 class="card-text">{{ $post->title }}</h5>
        <p>{!! htmlspecialchars_decode($post->content) !!}</p>
        <p class="card-text">{{ $post->description }}</p>

  </div>
  </div>
</div>
@endsection('content')

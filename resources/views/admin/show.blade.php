@extends('admin.layout')
@section('content')


<div class="card">
  <div class="card-header">Post Page</div>
  <div class="card-body">


        <div class="card-body">
        <h5 class="card-title">Thumbnail : {{ $post->thumbnail}}</h5>
        <p class="card-text">Title : {{ $post->title }}</p>
        <p class="card-text">Description : {{ $post->description }}</p>
        <p class="card-text">Status : {{ $post->status}}</p>
  </div>

    </hr>

  </div>
</div>

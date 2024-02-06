@extends('layouts.layout')
@section('content')


<div class="card">
    <div class="jumbotron">
        <h1 class="display-4">{{ $post->title }}</h1>
        <p class="lead"></p>
        <p>{!! htmlspecialchars_decode($post->content) !!}</p>
        <hr class="my-4">
        <p>{{ $post->description }}</p>
      </div>
</div>
@endsection('content')



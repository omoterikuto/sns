@extends('app')

@section('title', $tag->hashtag)

@section('content')
  @include('nav')
  <div class="container pb-4">
    <div class="card mt-3 cloudy-knoxville-gradient">
      <div class="card-body">
        <h4 class="card-title m-0">{{ $tag->hashtag }}</h4>
        <div class="card-text text-right">
          {{ $tag->articles->count() }}件
        </div>
      </div>
    </div>
    @foreach($tag->articles as $article)
      @include('articles.card')
    @endforeach
  </div>
@endsection
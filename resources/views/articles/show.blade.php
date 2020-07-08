@extends('app')

@section('title', '記事詳細')

@section('content')
  @include('nav')
  <div class="container pb-4">
    @include('articles.card',['show_all' => true, 'no_animate' => true])
    @include('articles.comment')
  </div>
@endsection
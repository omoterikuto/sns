@extends('app')

@section('title', '記事詳細')

@section('content')
  @include('nav')
  <div class="container">
    @include('articles.card',['show_all' => true])
    @include('articles.comment')
  </div>
@endsection
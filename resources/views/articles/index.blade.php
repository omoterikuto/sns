@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav')
  <div class="container pb-4">
    @foreach($articles as $article)
      @include('articles.card')
    @endforeach
    <div class="d-flex justify-content-center">
      {{ $articles->links('vendor.pagination.default') }}
    </div>
  </div>
@endsection
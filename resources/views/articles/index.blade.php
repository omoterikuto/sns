@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($articles as $article)
      @include('articles.card')
    @endforeach
    <div class="d-flex justify-content-center">
      {{ $articles_obj->links('vendor.pagination.default') }}
    </div>
  </div>
@endsection
@extends('app')

@section('title', '人気記事')

@section('content')
  @include('nav')
  <div class="container pb-4 pt-4">
    <h5 class="timeline-title d-inline-block p-3 pl-4 pr-4 rounded-pill animated slideInLeft"><i class="fas fa-fire mr-1"></i>人気記事</h5>
    @foreach($articles as $article)
      @include('articles.card')
    @endforeach
    <div class="d-flex justify-content-center">
      {{ $articles_obj->links('vendor.pagination.default') }}
    </div>
  </div>
@endsection
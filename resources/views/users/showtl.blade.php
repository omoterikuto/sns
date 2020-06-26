@extends('app')

@section('title', 'マイタイムライン')

@section('content')
  @include('nav')
  <div class="container pb-3 pt-4">
    <h5 class="text-white d-inline-block p-3 pl-4 pr-4 young-passion-gradient rounded-pill z-depth-1 animated slideInLeft">マイタイムライン</h5>
    @foreach($articles as $article)
      @include('articles.card')
    @endforeach
  </div>
@endsection
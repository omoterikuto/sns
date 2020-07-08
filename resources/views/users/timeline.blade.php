@extends('app')

@section('title', 'マイタイムライン')

@section('content')
  @include('nav')
  <div class="container pb-3 pt-4">
    <h5 class="timeline-title d-inline-block p-3 pl-4 pr-4 rounded-pill animated slideInLeft">マイタイムライン</h5>
    @if(empty($articles)) 
      <div class="shadow-inset mt-3 py-2 px-3 text-center overflow-hidden">
        <p class="animated slideInLeft m-0">フォローしているユーザーがいません。</p>
      </div>
    @else 
      @foreach($articles as $article)
        @include('articles.card')
      @endforeach
    @endif
  </div>
@endsection
@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container pb-4">
    @include('users.user')
    @include('users.tabs', ['hasArticles' => true, 'hasLikes' => false])
    @foreach($articles as $article)
      @include('articles.card')
    @endforeach
  </div>
@endsection
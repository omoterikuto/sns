@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container pb-4">
    @include('users.user')
    <ul class="nav nav-tabs nav-justified mt-3">
      <li class="nav-item">
        <a href="#post" class="nav-link active" data-toggle="tab">記事</a>
      </li>
      <li class="nav-item">
        <a href="#user" class="nav-link" data-toggle="tab">いいね</a>
      </li>
    </ul>
    <div class="tab-content">
      <div id="post" class="tab-pane active">
        @foreach($user_articles as $article)
          @include('articles.card')
        @endforeach
      </div>
      <div id="user" class="tab-pane">
        @foreach($like_articles as $article)
          @include('articles.card')
        @endforeach
      </div>
    </div>
  </div>
@endsection
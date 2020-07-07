@extends('app')

@section('title', $user->name . 'のフォロー中')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @foreach($followings as $person)
      @include('users.person')
    @endforeach
  </div>
@endsection
@extends('app')

@section('title', 'プロフィール編集')

@include('nav')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card mt-3">
        <div class="card-body p-0">
          @include('error_card_list')
            <form method="POST" class="m-0" action="{{ route('users.update', ['name' => $user->name]) }}">
              @csrf @method('PUT')
              <div class="card-body">
                <div class="d-flex flex-row">
                  <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                    <i class="fas fa-user-circle fa-3x"></i>
                  </a>
                  <div class="md-form mt-0 mb-0 ml-3">
                    <label for="name">ユーザー名</label>
                    <input class="form-control mb-0 pt-2" type="text" id="name" name="name" required value="{{ $user->name }}">
                  </div>
                </div>
                <div class="md-form">
                  <label>プロフィール文</label>
                  <textarea class="form-control pt-2 md-textarea" id="" name="profile">{{ $user->profile }}</textarea>
                </div>
              </div>
              <button type="submit" class="btn text-white young-passion-gradient btn-block">更新する</button>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
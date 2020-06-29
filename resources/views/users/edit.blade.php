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
                <div class="md-form mb-0">
                  <label class="mb-3">プロフィール文</label>
                  <textarea class="form-control md-textarea" id="" name="profile">{{ $user->profile }}</textarea>
                </div>
              </div>
              <div class="text-right">
                <button type="submit" class="btn text-white young-passion-gradient text-center">更新する</button>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
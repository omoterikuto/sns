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
          <form method="POST" class="m-0" action="{{ route('users.update', ['name' => $user->name]) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="card-body">
              <div class="d-flex flex-row">
                @if(isset($user->user_image))
                <image-modal :image-pass='@json($user->user_image)'></image-modal>
                @else
                <i class="fas fa-user-circle" style="font-size: 60px;"></i>
                @endif
                <div class="ml-auto mb-3">
                  <label for="name">ユーザー名</label>
                  <input class="shadow-inset mb-0 pt-2" type="text" id="name" name="name" required value="{{ $user->name }}">
                </div>
              </div>
              <div class="">
                <label data-browse="ファイルを選択">ユーザー画像</label>
                <input type="file" class="shadow-inset" name="user_image">
              </div>
              <div class="mb-0">
                <label class="mt-2">プロフィール文</label>
                <textarea class="" id="" name="profile">{{ $user->profile }}</textarea>
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
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
                <div class="ml-auto md-form">
                  <label for="name">ユーザー名</label>
                  <input class="form-control mb-0 pt-2" type="text" id="name" name="name" required value="{{ $user->name }}">
                </div>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFileLangHTML" name="user_image">
                <label class="custom-file-label" for="customFileLangHTML" data-browse="ファイルを選択">ユーザー画像</label>
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
@extends('app')

@section('title', 'ユーザー登録')

@section('content')
  <div class="container mt-3">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <h1 class="text-center"><a class="deep-orange-text" href="/">MYNOTE</a></h1>
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">ユーザー登録</h2>

            @include('error_card_list')
            
            <div class="card-text">
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="text-left">
                  <label for="name">ユーザー名</label>
                  <input class="shadow-inset" type="text" id="name" name="name" required value="{{ old('name') }}">
                  <small>3〜16文字</small>
                </div>
                <div class="text-left mt-3">
                  <label for="email">メールアドレス</label>
                  <input class="shadow-inset" type="text" id="email" name="email" required value="{{ old('email') }}" >
                </div>
                <div class="text-left mt-3">
                  <label for="password">パスワード</label>
                  <input class="shadow-inset" type="password" id="password" name="password" required>
                </div>
                <div class="text-left mt-3">
                  <label for="password_confirmation">パスワード(確認)</label>
                  <input class="shadow-inset" type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button class="btn btn-block young-passion-gradient text-white mt-2 mb-2" type="submit">ユーザー登録</button>
              </form>
              <div class="mt-0">
                <a href="{{ route('login') }}" class="card-text">ログインはこちら</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
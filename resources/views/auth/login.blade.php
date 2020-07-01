@extends('app')

@section('title', 'ログイン')

@section('content')
  <div class="container mt-3">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <h1 class="text-center"><a class="deep-orange-text" href="/">MYNOTE</a></h1>
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">ログイン</h2>
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="text-left">
                  <label for="email">メールアドレス</label>
                  <input class="shadow-inset" type="text" id="email" name="email" required value="{{ old('email') }}">
                </div>
                <div class="text-left mt-3 mb-2">
                  <label for="password">パスワード</label>
                  <input class="shadow-inset" type="password" id="password" name="password" required>
                </div>
                <input type="hidden" name="remember" id="remember" value="on">
                {{-- <div class="text-left">
                  <a href="{{ route('password.request') }}" class="card-text">パスワードを忘れた方</a>
                </div> --}}
                <button class="btn btn-block young-passion-gradient mt-2 mb-2 text-white" type="submit">ログイン</button>
              </form>
              <div class="mt-0">
                <a href="{{ route('register') }}" class="card-text mt-1">ユーザー登録はこちら</a>
              </div>
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" id="email" name="email" required value="example@mail.com">
                <input type="hidden" id="password" name="password" required value="password">
                <p class="mt-4 mb-0">または</p>
                <button class="btn btn-inline young-passion-gradient mt-1 mb-1 text-white" type="submit">デモユーザーで簡単ログイン</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
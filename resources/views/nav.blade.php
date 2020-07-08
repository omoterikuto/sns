<nav class="navbar navbar-expand navbar-dark young-passion-gradient sticky-top">
  <a class="navbar-brand mr-0" href="/"><i class="fas fa-book-open mr-1"></i>MYNOTE</a>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('articles.popular') }}"><i class="fas fa-fire"></i>人気</a>
    </li>
    @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
      </li>
    @endguest
    @auth
      <li class="nav-item">
        <a class="nav-link" href="{{ route('articles.create') }}"><i class="far fa-edit"></i>投稿する</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-primary z-depth-1 border-0" aria-labelledby="navbarDropdownMenuLink">
          <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.timeline",["name" => Auth::user()->name]) }}'">
            マイタイムライン
          </button>
          <div class="dropdown-divider"></div>
          <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.show",["name" => Auth::user()->name]) }}'">
            マイページ
          </button>
          <div class="dropdown-divider"></div>
          <button form="logout-button" class="dropdown-item" type="submit">
            ログアウト
          </button>
        </div>
      </li>
      <form id="logout-button" method="POST" action="{{ route('logout') }}">
        @csrf
      </form>
    @endauth
  </ul>
</nav>
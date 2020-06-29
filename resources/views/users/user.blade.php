<div class="card mt-3 cloudy-knoxville-gradient">
  <div class="card-body">
    <div class="d-flex flex-row">
      @if(isset($user->user_image))
        <img class="rounded-circle" src="/storage/{{$user->user_image}}" alt="ユーザー画像" width="48px" style="object-fit: cover; min-height:48px;">
      @else
        <i class="fas fa-user-circle fa-3x"></i>
      @endif
      <h2 class="h5 card-title ml-3 mt-2">
        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
          {{ $user->name }}
        </a>
      </h2>
      @if( Auth::id() !== $user->id )
        <follow-button
          class="ml-auto"
          :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
          :authorized='@json(Auth::check())'
          endpoint="{{ route('users.follow', ['name' => $user->name]) }}">
        </follow-button>
      @elseif( Auth::id() == $user->id )
        <a class="ml-auto border border-primary" href="{{ route('users.edit', ['name' => $user->name]) }}" 
        style="
        margin: 7px 0;
        line-height: 2.6;
        font-size: 13px;
        padding: 0 13px;
        border-radius: 3px;">
        編集</a>
      @endif
    </div>
  </div>
  <div class="card-body">
    <p>
      {{ $user->profile }}
    </p>
  </div>
  <div class="card-body">
    <div class="card-text">
      <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followings }} フォロー
      </a>
      <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followers }} フォロワー
      </a>
    </div>
  </div>
</div>
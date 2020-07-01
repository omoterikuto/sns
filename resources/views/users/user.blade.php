<div class="card mt-3 cloudy-knoxville-gradient">
  <div class="card-body">
    <div class="d-flex flex-row">
      @if(isset($user->user_image))
        <image-modal :image-pass='@json($user->user_image)'></image-modal>
      @else
        <i class="fas fa-user-circle" style="font-size: 60px;"></i>
      @endif
      <h5 class="card-title ml-3 mt-3">
        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
          {{ $user->name }}
        </a>
      </h5>
      @if( Auth::id() !== $user->id )
        <follow-button
          class="ml-auto mt-2"
          :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
          :authorized='@json(Auth::check())'
          endpoint="{{ route('users.follow', ['name' => $user->name]) }}">
        </follow-button>
      @elseif( Auth::id() == $user->id )
        <a class="ml-auto edit-btn" href="{{ route('users.edit', ['name' => $user->name]) }}">編集</a>
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
<div class="card mt-3 cloudy-knoxville-gradient">
  <div class="card-body">
    <div class="d-flex flex-row">
      @if(isset($user->user_image))
        <image-modal :image-pass='@json($user->user_image)'></image-modal>
      @else
        <i class="fas fa-user-circle profile-noimg"></i>
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
      {!! nl2br(e($user->profile)) !!}
    </p>
  </div>
  <div class="card-body">
    <div class="card-text">
      <ul class="nav nav-tabs d-flex p-0 m-0">
        <li class="nav-item">
          <a href="#following" class="text-muted nav-item" data-toggle="tab">
            フォロー  {{ $user->count_followings }}
          </a>
        </li>
        <li class="nav-item ml-2">
          <a href="#follower" class="text-muted nav-item" data-toggle="tab">
            フォロワー  {{ $user->count_followers }}
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div id="following" class="tab-pane">
          @foreach($followings as $person)
            @include('users.person')
          @endforeach
        </div>
        <div id="follower" class="tab-pane">
          @foreach($followers as $person)
            @include('users.person')
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
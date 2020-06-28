<div class="card mt-3 cloudy-knoxville-gradient">
  <div class="card-body">
    <div class="d-flex flex-row">
      <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark">
        <i class="fas fa-user-circle fa-3x"></i>
      </a>
      <h2 class="h5 card-title ml-3 mt-2">
        <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark">{{ $person->name }}</a>
      </h2>
      @if( Auth::id() !== $person->id )
        <follow-button
          class="ml-auto mt-1"
          :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
          :authorized='@json(Auth::check())'
          endpoint="{{ route('users.follow', ['name' => $person->name]) }}">
        </follow-button>
      @endif
    </div>
  </div>
</div>

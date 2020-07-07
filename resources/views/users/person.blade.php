<div class="card mt-3 animated fadeIn faster">
  <div class="card-body">
    <div class="d-flex flex-row">
      <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark">
        @if(isset($person->user_image))
          <img src="/storage/{{$person->user_image}}" class="person-user-icon" alt="">
        @else
          <i class="fas fa-user-circle person-user-icon"></i>
        @endif
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

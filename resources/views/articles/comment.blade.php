<h5 class="timeline-title my-3 mb-0 py-3 px-4 rounded-pill">コメント</h5>
@include('error_card_list')
<form method="POST" action="{{ route('articles.comment', ['article' => $article]) }}">
  @csrf
  <div>
    <textarea name="comment" rows="6"></textarea>
    <input type="hidden" name="article_id" value="{{$article->id}}">
  </div>
  <button type="submit" class="btn young-passion-gradient text-white d-block ml-auto">コメントする</button>
</form>
@foreach($comments as $comment)
<div class="card mt-3 p-4">
  <div class="d-flex">
    <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="text-dark">
      @if(isset($comment->user->user_image))
      <img class="post-user-icon z-depth-1" src="/storage/{{$comment->user->user_image}}" alt="ユーザー画像">
      @else
      <i class="fas fa-user-circle fa-3x post-user-icon"></i>
      @endif
    </a>
    <div class="ml-2">
      <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="text-dark">
        <div class="font-weight-bold">{{ $comment->user->name }}</div>
      </a>
      <div class="font-weight-lighter">{{ $article->created_at->format('Y/m/d H:i') }}</div>
    </div>
  </div>
  <div class="card-text mt-2">
    {!! nl2br(e($comment->comment)) !!}
  </div>
</div>
@endforeach
<div class="d-flex justify-content-center">
  {{ $comments_obj->links('vendor.pagination.default') }}
</div>
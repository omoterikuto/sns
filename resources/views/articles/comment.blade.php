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
    <div class="ml-auto">
      @if( Auth::id() === $comment->user_id || Auth::id() === $article->id )
      <!-- dropdown -->
      <div class="ml-auto card-text">
        <div class="dropdown">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right z-depth-1 border-0">
            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $comment->id }}">
              <i class="fas fa-trash-alt mr-1"></i>記事を削除する
            </a>
          </div>
        </div>
      </div>
      <!-- dropdown -->
      <!-- modal -->
      <div id="modal-delete-{{ $comment->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form method="POST" action="{{ route('articles.comment.destroy', ['comment' => $comment]) }}">
              @csrf 
              @method('DELETE')
              <div class="modal-body">
                コメントを削除します。よろしいですか？
              </div>
              <input type="hidden" name="article_id" value="{{ $article->id }}">
              <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">削除する</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
      @endif
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
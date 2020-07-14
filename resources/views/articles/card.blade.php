<div class="card mt-3 {{isset($no_animate) ? '' : 'animated slideInUp faster'}}">
  <div class="card-body d-flex flex-row">
    <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
      @if(isset($article->user->user_image))
        <img class="post-user-icon z-depth-1" src="/storage/{{$article->user->user_image}}" alt="ユーザー画像">
      @else
        <i class="fas fa-user-circle fa-3x post-user-icon"></i>
      @endif
    </a>
    <div class="ml-2">
      <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
        <div class="font-weight-bold">{{ $article->user->name }}</div>
      </a>
      <div class="font-weight-lighter">{{ $article->created_at->format('Y/m/d H:i') }}</div>
    </div>
    @if( Auth::id() === $article->user_id )
    <!-- dropdown -->
    <div class="ml-auto card-text">
      <div class="dropdown">
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right z-depth-1 border-0">
          <a class="dropdown-item" href="{{ route("articles.edit", ['article' => $article]) }}">
            <i class="far fa-edit mr-1"></i>記事を更新する
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-post-delete-{{ $article->id }}">
            <i class="fas fa-trash-alt mr-1"></i>記事を削除する
          </a>
        </div>
      </div>
    </div>
    <!-- dropdown -->
    
    @endif
  </div>
  <div class="card-body pt-0 pb-0">
    <h3 class="h4 card-title">
      <a class="text-dark" href="{{ route('articles.show', ['article' => $article]) }}">
        {{ $article->title }}
      </a>
    </h3>
    <div class="card-text">
      @if(isset($show_all))
        {!! nl2br(e($article->body)) !!}
      @else
        {!! nl2br(e( Str::limit($article->body, 300 ))) !!}
      @endif
    </div>
    @if(strlen($article->body) > 300 && !isset($show_all))
    <div class="text-right pr-3 mt-2">
      <a class="continue-btn px-2 py-1" href="{{ route('articles.show', ['article' => $article]) }}"><small>続きを読む</small></a>
    </div>
    @endif
    <div class="card-body pt-0 pb-2 pl-0">
      <div class="card-text">
        <article-like :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))' 
          :initial-count-likes='@json($article->count_likes)' 
          :authorized='@json(Auth::check())' 
          endpoint="{{ route('articles.like', ['article' => $article]) }}">
        </article-like>
      </div>
    </div>
    @foreach($article->tags as $tag) @if($loop->first)
    <div class="card-body pt-0 pb-4 pl-0">
      <div class="card-text line-height">
        @endif
        <a class="tag-btn py-1 px-2" href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
          {{ $tag->hashtag }}        
        </a>
        @if($loop->last)
      </div>
    </div>
    @endif
    @endforeach
  </div>
</div>
<!-- modal -->
<div id="modal-post-delete-{{ $article->id }}" class="modal fade mt-3" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
        @csrf 
        @method('DELETE')
        <div class="modal-body">
          {{ $article->title }}を削除します。よろしいですか？
        </div>
        <div class="modal-footer justify-content-between">
          <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
          <button type="submit" class="btn btn-danger">削除する</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- modal -->
@csrf
<div class="mt-3 mb-3">
  <label>タイトル</label>
  <input type="text" name="title" class="shadow-inset" required value="{{ $article->title ?? old('title') }}">
</div>
<div class="form-group">
  <article-tags-input 
    :initial-tags='@json($tagNames ?? [])'
    :autocomplete-items='@json($allTagNames ?? [])'>
  </article-tags-input>
</div>
<div>
  <label>本文</label>
  <textarea name="body" required rows="16">{{ $article->body ?? old('body') }}</textarea>
</div>
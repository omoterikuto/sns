<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Tag;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  public function __construct()
  {
    $this->authorizeResource(Article::class, 'article');
  }

  public function index()
  {
    $articles = Article::with(['user', 'likes', 'tags'])->orderBy('created_at', 'desc')->paginate(10);
    return view('articles.index', [
      'articles' => $articles,
    ]);
  }

  public function popular()
  {
    $articles_obj = Article::withCount('likes')->orderbyRaw('likes_count desc, created_at desc')->paginate(10);
    $articles = $articles_obj->load(['user', 'likes', 'tags']);
    return view('articles.popular', [
      'articles_obj' => $articles_obj,
      'articles' => $articles,
    ]);
  }

  public function create()
  {
    $allTagNames = Tag::all()->map(function ($tag) {
      return ['text' => $tag->name];
    });
    return view('articles.create', [
      'allTagNames' => $allTagNames,
    ]);
  }

  public function store(ArticleRequest $request, Article $article)
  {
    $article->fill($request->all());
    $article->user_id = $request->user()->id;
    $article->save();
    $request->tags->each(function ($tagName) use ($article) {
      $tag = Tag::firstOrCreate(['name' => $tagName]);
      $article->tags()->attach($tag);
    });
    return redirect()->route('articles.index');
  }

  public function edit(Article $article)
  {
    $tagNames = $article->tags->map(function ($tag) {
      return ['text' => $tag->name];
    });
    $allTagNames = Tag::all()->map(function ($tag) {
      return ['text' => $tag->name];
    });
    return view('articles.edit', [
      'article' => $article,
      'tagNames' => $tagNames,
      'allTagNames' => $allTagNames,
    ]);
  }

  public function update(ArticleRequest $request, Article $article)
  {
    $article->fill($request->all())->save();
    $article->tags()->detach();
    $request->tags->each(function ($tagName) use ($article) {
      $tag = Tag::firstOrCreate(['name' => $tagName]);
      $article->tags()->attach($tag);
    });
    return redirect()->route('articles.index');
  }

  public function destroy(Article $article)
  {
    $article->delete();
    return redirect()->route('articles.index');
  }

  public function show(Article $article)
  {
    $comments_obj = Comment::where('article_id', $article->id)->orderBy('created_at', 'DESC')->paginate(10);
    $comments = $comments_obj->load(['user']);
    return view(
      'articles.show',
      [
        'article' => $article,
        'comments' => $comments,
        'comments_obj' => $comments_obj
      ]
    );
  }

  public function like(Request $request, Article $article)
  {
    $article->likes()->detach($request->user()->id);
    $article->likes()->attach($request->user()->id);
    return [
      'id' => $article->id,
      'countLikes' => $article->count_likes,
    ];
  }

  public function unlike(Request $request, Article $article)
  {
    $article->likes()->detach($request->user()->id);
    return [
      'id' => $article->id,
      'countLikes' => $article->count_likes,
    ];
  }
}

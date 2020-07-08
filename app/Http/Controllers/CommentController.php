<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{

  public function store(CommentRequest $request, Comment $comment)
  {
    $comment->comment = $request->comment;
    $comment->user_id = $request->user()->id;
    $comment->article_id = $request->article_id;
    $comment->save();
    return redirect()->route('articles.show', ['article' => $request->article_id]);
  }

  public function destroy(Comment $comment)
  {
    $comment->delete();
    return redirect()->route('articles.show', ['article' => $comment->article_id]);
  }
}

<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
  public function store(Request $request, Comment $comment)
  {
    // $request->validate([
    //   'comment' => 'required|string|max:200',
    // ]);
    $comment->comment = $request->comment;
    $comment->user_id = $request->user()->id;
    $comment->article_id = $request->article_id;
    $comment->save();
    return redirect()->route(
      'articles.show',
      [
        'article' => $request->article_id
      ]
    );
  }
}

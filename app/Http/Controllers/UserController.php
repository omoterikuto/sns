<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

  public function show(string $name)
  {
    $user = User::where('name', $name)->first()->load(
      [
        'articles.user', 'articles.likes', 'articles.tags', 'followings.followers', 'likes.user', 'likes.likes', 'likes.tags', 'followers.followers'
      ]
    );
    $user_articles = $user->articles->sortByDesc('created_at');
    $like_articles = $user->likes->sortByDesc('created_at');
    $followings = $user->followings->sortByDesc('created_at');
    $followers = $user->followers->sortByDesc('created_at');
    return view('users.show', [
      'user' => $user,
      'followings' => $followings,
      'followers' => $followers,
      'user_articles' => $user_articles,
      'like_articles' => $like_articles,
    ]);
  }

  public function follow(Request $request, string $name)
  {
    $user = User::where('name', $name)->first();
    if ($user->id === $request->user()->id) {
      return abort('404', 'Cannot follow yourself.');
    }
    $request->user()->followings()->detach($user);
    $request->user()->followings()->attach($user);
    return ['name' => $name];
  }

  public function unfollow(Request $request, string $name)
  {
    $user = User::where('name', $name)->first();
    if ($user->id === $request->user()->id) {
      return abort('404', 'Cannot follow yourself.');
    }
    $request->user()->followings()->detach($user);
    return ['name' => $name];
  }

  public function showTl(string $name)
  {
    $article_list = array();
    $user = User::where('name', $name)->first();
    if ($user->followings->isNotEmpty()) {
      $followings = $user->followings->load(['articles.user', 'articles.likes', 'articles.tags']);
      foreach ($followings as $following) {
        $articles_list = array();
        $articles_list = $following->articles;
        foreach ($articles_list as $list) {
          $article_list[] = $list;
        }
      }
      foreach ($article_list as $key => $value) {
        $id[$key] = $value['created_at'];
      }
      array_multisort($id, SORT_DESC, $article_list);
    }
    return view('users.timeline', [
      'user' => $user,
      'articles' => $article_list,
    ]);
  }
  public function edit(string $name)
  {
    if (\Auth::user()->name == $name) {
      $user = User::where('name', $name)->first();
      return view('users.edit', [
        'user' => $user,
      ]);
    } else {
      return redirect()->route('users.show', [
        'name' => $name,
      ]);
    }
  }
  public function update(ProfileRequest $request)
  {
    $user_id = $request->user()->id;
    // ユーザー画像処理
    if (isset($request->user_image)) {
      Storage::delete('public/' . $request->user()->user_image);
      $original_image = $request->user_image;
      $filePath = $original_image->store('public');
      $file_name = str_replace('public/', '', $filePath);
      User::where('id', $user_id)->update([
        'user_image' => $file_name
      ]);
    }
    // ユーザーネーム、プロフィール処理
    User::where('id', $user_id)->update([
      'profile' => $request->profile,
      'name' => $request->name
    ]);
    return redirect()->route('users.show', [
      'name' => $request->name,
    ]);
  }
}

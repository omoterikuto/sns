<?php

Auth::routes();
Route::get('/', 'ArticleController@index')->name('articles.index');
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);
Route::prefix('articles')->name('articles.')->middleware('auth')->group(function () {
  Route::put('/{article}/like', 'ArticleController@like')->name('like');
  Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike');
  Route::post('/comment', 'CommentController@store')->name('comment');
});
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
Route::prefix('users')->name('users.')->group(function () {
  Route::get('/{name}', 'UserController@show')->name('show');
  Route::get('/{name}/likes', 'UserController@likes')->name('likes');
  Route::get('/{name}/followings', 'UserController@followings')->name('followings');
  Route::get('/{name}/followers', 'UserController@followers')->name('followers');
  Route::middleware('auth')->group(function () {
    Route::get('/{name}/timeline', 'UserController@showTl')->name('timeline');
    Route::get('/{name}/edit', 'UserController@edit')->name('edit');
    Route::put('/{name}/update', 'UserController@update')->name('update');
    Route::put('/{name}/follow', 'UserController@follow')->name('follow');
    Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
  });
});

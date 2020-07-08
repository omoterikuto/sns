<?php

Auth::routes();
Route::get('/', 'ArticleController@index')->name('articles.index');
Route::get('/popular', 'ArticleController@popular')->name('articles.popular');
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);
Route::prefix('articles')->name('articles.')->middleware('auth')->middleware('auth')->group(function () {
  Route::put('/{article}/like', 'ArticleController@like')->name('like');
  Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike');
  Route::post('/comment', 'CommentController@store')->name('comment');
  Route::delete('/comment/{comment}', 'CommentController@destroy')->name('comment.destroy');
});
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
Route::prefix('users')->name('users.')->group(function () {
  Route::get('/{name}', 'UserController@show')->name('show');
  Route::middleware('auth')->group(function () {
    Route::get('/{name}/timeline', 'UserController@showTl')->name('timeline');
    Route::get('/{name}/edit', 'UserController@edit')->name('edit');
    Route::put('/{name}/update', 'UserController@update')->name('update');
    Route::put('/{name}/follow', 'UserController@follow')->name('follow');
    Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
  });
});

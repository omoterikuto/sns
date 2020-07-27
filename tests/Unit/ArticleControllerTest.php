<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
  use RefreshDatabase;

  public function testCreateArticle()
  {
    #アップロードした記事データがDBにあるかテスト
    $user = factory(User::class)->create();

    $response = $this->actingAs($user);

    $user_id = $user->id;
    $test_title = "testtitle";
    $test_body = "test";
    $testTags = ["test1", "test2", "test3", "test4", "test5"];
    $response->post('/articles', ['title' => $test_title, 'body' => $test_body]);
    $response->assertDatabaseHas('articles', [
      'title' => $test_title,
      'body' => $test_body,
      'user_id' => $user_id
    ]);

    #タイトル0文字または51文字以上の記事が投稿されないかテスト
    $lengths = [0, 51];
    foreach ($lengths as $length) {
      $bad_test_title = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', $length)), 0, $length);

      $response->post('/articles', ['title' => $bad_test_title, 'body' => $test_body]);
      $response->assertDatabaseMissing('articles', [
        'title' => $bad_test_title,
        'body' => $test_body,
        'user_id' => $user_id
      ]);
    }
  }
  // public function testUpdateArticle()
  // {
  //   #更新した記事データがDBにあるかテスト
  //   $user = factory(User::class)->create();
  //   $article = factory(Article::class)->create();
  //   $response = $this->actingAs($article->user);

  //   $user_id = $user->id;
  //   $testTitle = "テストタイトル";
  //   $testBody = "テスト";

  //   $testTags = ["テスト1", "テスト2", "テスト3", "テスト4", "テスト5"];
  //   $response->put("/articles/{$article->id}", ['title' => $testTitle, 'body' => $testBody])->assertStatus(200);
  // $response->assertDatabaseHas('articles', [
  //   'title' => $testTitle,
  //   'body' => $testBody,
  //   'user_id' => $article->user_id
  // ]);

  #不正な形式の記事が登録されないかテスト
  #タイトル0文字または３1文字以上の記事が投稿されないかテスト
  // $lengths = [0, 31];
  // foreach ($lengths as $length) {
  //   $Bad_testTitle = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', $length)), 0, $length);

  //   $response->post("/articles/{$article}/edit", ['title' => $Bad_testTitle, 'body' => $testBody]);
  //   $response->assertDatabaseMissing('articles', [
  //     'title' => $Bad_testTitle,
  //     'body' => $testBody,
  //     'user_id' => $user_id
  //   ]);
  // }
  // }
}

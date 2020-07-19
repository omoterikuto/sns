<?php

namespace Tests\Feature;

use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
  use RefreshDatabase;

  protected $user;

  public function setUp(): void
  {
    parent::setUp();

    // テストユーザ作成
    $this->user = factory(User::class)->create();
  }

  /**
   * ログイン認証テスト
   */
  public function testLogin(): void
  {
    // 作成したテストユーザのemailとpasswordで認証リクエスト
    $response = $this->json('POST', route('login'), [
      'email' => $this->user->email,
      'password' => 'password',
    ]);

    // 正しいレスポンスが返り、ユーザ名が取得できることを確認
    $response
      ->assertStatus(200)
      ->assertJson(['name' => $this->user->name]);

    // 指定したユーザーが認証されていることを確認
    $this->assertAuthenticatedAs($this->user);
  }

  /**
   * ログアウトテスト
   */
  public function testLogout(): void
  {
    // actingAsヘルパで現在認証済みのユーザーを指定する
    $response = $this->actingAs($this->user);

    // ログアウトページへリクエストを送信
    $response->json('POST', route('logout'));

    // ログアウト後のレスポンスで、HTTPステータスコードが正常であることを確認
    $response->assertStatus(200);

    // ユーザーが認証されていないことを確認
    $this->assertGuest();
  }
}

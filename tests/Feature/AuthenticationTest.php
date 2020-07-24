<?php

use App\Favorite;
use App\User;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
  use RefreshDatabase;
  /**
   * A basic feature test example.
   *
   * @return void
   */

  public function testRegisterUser()
  {
    $user = factory(User::class)->create();
    $this->post('/register', ['name' => $user->name, 'email' => $user->email, 'password' => $user->password, 'password_confirmation' => $user->password]);
    $this->assertDatabaseHas('users', [
      'name' => $user->name,
      'email' => $user->email,
      'password' => $user->password,
      'user_image' => $user->user_image,
      'profile' => $user->profile
    ]);
  }
}

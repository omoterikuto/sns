<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
  use RefreshDatabase;

  public function testUserIndex()
  {
    $user = factory(User::class)->create();

    $response = $this->actingAs($user)->get(route('users.show', ['name' => $user->name]));

    $response->assertStatus(200);
  }

  public function testMyTimeline()
  {
    $user = factory(User::class)->create();

    $response = $this->actingAs($user)->get(route('users.timeline', ['name' => $user->name]));

    $response->assertStatus(200);
  }
}

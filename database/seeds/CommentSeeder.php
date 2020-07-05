<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    for ($i = 1; $i <= 6; $i++) {
      DB::table('comments')->insert([
        'comment' => 'テスト - ' . $i,
        'article_id' => 1,
        'user_id' => 2,
        'updated_at' => new DateTime(),
        'created_at' => new DateTime(),
      ]);
    }
  }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
  public function user(): belongsTo
  {
    return $this->belongsTo('App\User');
  }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class preset extends Model
{
    protected $fillable = [
      'presetName', 'width', 'height', 'xval', 'yval', 'position', 'user'
  ];
}

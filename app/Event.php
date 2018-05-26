<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'category', 'datetime','shortdescription', 'longdescription', 'location', 'organiserid', 'imagepath', 'imagename', 'docpath', 'related', 'weblink',
  ];
}

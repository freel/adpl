<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobHistory extends Model
{
  protected $table = 'jobs_history';

  /**
   * Return headers of visible rows for JobHistory lists in web view and download:view command
   *
   * @return array
   */
  public static function headers()
  {
    return ["id", "filename", "status"];
  }
}

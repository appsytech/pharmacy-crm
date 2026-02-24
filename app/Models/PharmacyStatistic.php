<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyStatistic extends Model
{
      protected $guarded = ['id'];

    protected $table = 'pharmacy_statistics';

    protected $primaryKey = 'id';

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckupProcess extends Model
{
    protected $guarded = ['id'];

    protected $table = 'checkup_process';
    protected $primaryKey = 'id';

    public $timestamps = false;
}

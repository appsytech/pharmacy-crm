<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogMoney extends Model
{
    protected $guarded = ['id'];

    protected $table = 'log_money';

    protected $primaryKey = 'id';

    public $timestamps = false;
}

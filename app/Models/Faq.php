<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $guarded = ['id'];

    protected $table = 'faq';

    protected $primaryKey = 'id';

    public $timestamps = false;
}

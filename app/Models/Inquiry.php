<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $guarded = ['id'];

    protected $table = 'inquiries';

    protected $primaryKey = 'id';

    public $timestamps = false;
}

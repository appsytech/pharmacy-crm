<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    protected $guarded = ['id'];

    protected $table = 'expense_type';

    protected $primaryKey = 'id';

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['interest','period_id','package_id'];
    protected $table = "loan_interest";
}

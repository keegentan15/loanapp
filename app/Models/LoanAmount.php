<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanAmount extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "loan_package";
}

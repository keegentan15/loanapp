<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPackage extends Model
{
    use HasFactory;
    protected $table = 'loanpackage';
    public $timestamps = false;
    protected $fillable = ['Amount','CollectAmount','CreditAmount','Day','IncrementAmount','IncrementPeriod','Status'];
}

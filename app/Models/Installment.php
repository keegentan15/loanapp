<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Installment extends Model
{
    use HasFactory;
    protected $fillable = ['years','months'];
    public $timestamps = false;
    protected $table = 'installment';
}

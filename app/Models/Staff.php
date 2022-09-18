<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'Username','Password','Email', 'status1','created_at'
    ];

}

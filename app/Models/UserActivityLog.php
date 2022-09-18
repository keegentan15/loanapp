<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserActivityLog extends Model
{
    use HasFactory;
    protected $table = 'staff_activitylog';
    protected $fillable = ['UserID','Action','Content'];

}
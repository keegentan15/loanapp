<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact_book';
    protected $fillable = ['name','user_id','contact_name','contact_no'];
    public $timestamps = false;

}

<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Inquiry extends Model
{
    use HasFactory;

    protected $table = 'inquiry';
  
    protected $fillable = [
        'Name', 'Email', 'Subject', 'Message','Status','created_at'
    ];
}
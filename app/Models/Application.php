<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'photo', 'qualification', 'resume', 'location_preference'
    ];
}

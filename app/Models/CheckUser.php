<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckUser extends Model
{
    use HasFactory;
    protected $table = 'register_user';
    protected $fillable =['username', 'phone_number'];
}

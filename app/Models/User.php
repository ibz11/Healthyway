<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
//  Model
{
    use HasFactory;


protected $fillable=[
'full_name',
'email',
'phone',
'password'
    ];
}

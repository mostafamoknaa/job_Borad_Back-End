<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'role',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function employer()
    {
        return $this->hasOne(Employer::class);
    }
}

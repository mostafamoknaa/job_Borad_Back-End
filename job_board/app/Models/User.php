<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory;
    use Notifiable;
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
    public function applications()
    {
        return $this->hasMany(Application::class,'candidate_id');
    }
}

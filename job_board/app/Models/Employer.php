<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company_name',
        'company_description',
        'company_logo',
        'industry',
        'website',
        'company_size',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    public function latestJob()
    {
        return $this->hasOne(Job::class)->latest();
    }   

}

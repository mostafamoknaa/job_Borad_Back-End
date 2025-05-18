<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'experience_level',
        'education',
        'image',
    ];

    // public function jobs(){
    //     return $this->belongsTo(Job::class,"applications");
    // }

    public function user()
{
    return $this->belongsTo(User::class);
}
}

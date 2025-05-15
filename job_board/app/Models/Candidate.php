<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Candidate extends Model
{
    use HasFactory;

    public function jobs(){
        return $this->belongsTo(Job::class,"applications");
    }
}

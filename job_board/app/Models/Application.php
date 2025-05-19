<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;
use App\Models\Candidate;

class Application extends Model
{
    use HasFactory;
    protected $fillable = ['job_id', 'candidate_id', 'resume', 'cover_letter'];
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}

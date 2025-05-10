<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
            

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'location',
        'type',
        'category_id',
        'salary_range',
        'experience',
        'description',
        'responsibilities',
        'qualifications',
        'benefits',
        'application_deadline',
        'status',
        'approved_at',
        'approved_by',
        'employer_id'
    ];
}

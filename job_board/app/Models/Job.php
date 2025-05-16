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
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(Employer::class);
    }

    public function candidates(){
        return $this->hasMany(Candidate::class);
    }

}

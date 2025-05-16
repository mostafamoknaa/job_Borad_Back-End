<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class JobSeeder extends Seeder
{
    public function run()
    {
        $jobs = [
            [
                'title' => 'Technical Support Specialist',
                'location' => 'Dhaka, Bangladesh',
                'type' => 'part-time',
                'salary_range' => '$20,000 - $25,000',
                'category_id' => 1,
                'description' => 'Provide technical support to customers.',
                'responsibilities' => 'Resolve technical issues and document processes.',
                'qualifications' => 'Bachelor\'s degree in IT or related field.',
                'benefits' => 'Flexible hours, health insurance.',
                'application_deadline' => Carbon::now()->addDays(10),
                'status' => 'pending',
                'approved_at' => now(),
                'approved_by' => 1,
                'employer_id' => 1,
            ],
            [
                'title' => 'Senior UX Designer',
                'location' => 'Cairo, Egypt',
                'type' => 'full-time',
                'salary_range' => '$20,000 - $25,000',
                'category_id' => 2,
                'description' => 'Design user-friendly interfaces.',
                'responsibilities' => 'Work with dev team to implement designs.',
                'qualifications' => '3+ years experience in UX design.',
                'benefits' => 'Remote work, team outings.',
                'application_deadline' => Carbon::now()->addDays(15),
                'status' => 'approved',
                'approved_at' => now(),
                'approved_by' => 1,
                'employer_id' => 1,
            ],
            [
                'title' => 'Marketing Officer',
                'location' => 'Dubai, UAE',
                'type' => 'internship',
                'salary_range' => '$10,000 - $15,000',
                'category_id' => 3,
                'description' => 'Assist in marketing campaigns.',
                'responsibilities' => 'Social media management, research.',
                'qualifications' => 'Bachelor\'s in Marketing or Business.',
                'benefits' => 'Certificate, stipend.',
                'application_deadline' => Carbon::now()->addDays(7),
                'status' => 'rejected',
                'approved_at' => now(),
                'approved_by' => 1,
                'employer_id' => 1,
            ],
            [
                'title' => 'Full Stack Developer',
                'location' => 'Riyadh, Saudi Arabia',
                'type' => 'contract',
                'salary_range' => '$10,000 - $15,000',
                'category_id' => 4,
                'description' => 'Build and maintain web applications.',
                'responsibilities' => 'Develop and deploy software.',
                'qualifications' => 'Bachelor\'s in Computer Science or related field.',
                'benefits' => 'Flexible hours, health insurance.',
                'application_deadline' => Carbon::now()->addDays(7),
                'status' => 'archived',
                'approved_at' => now(),
                'approved_by' => 1,
                'employer_id' => 1,
            ],
            [
                'title' => 'Graphic Designer',
                'location' => 'London, England',
                'type' => 'freelance',
                'salary_range' => '$10,000 - $15,000',
                'category_id' => 5,
                'description' => 'Create visual content for various media.',
                'responsibilities' => 'Design graphics, logos, and layouts.',
                'qualifications' => 'Bachelor\'s in Graphic Design or related field.',
                'benefits' => 'Remote work, team outings.',
                'application_deadline' => Carbon::now()->addDays(7),
                'status' => 'pending',
                'approved_at' => now(),
                'approved_by' => 1,
                'employer_id' => 1,
            ],
            [
                'title' => 'Project Manager',
                'location' => 'New York, USA',
                'type' => 'temporary',
                'salary_range' => '$10,000 - $15,000',
                'category_id' => 6,
                'description' => 'Manage project timelines and resources.',
                'responsibilities' => 'Coordinate with team members, clients.',
                'qualifications' => 'Bachelor\'s in Project Management or related field.',
                'benefits' => 'Flexible hours, health insurance.',
                'application_deadline' => Carbon::now()->addDays(7),
                'status' => 'pending',
                'approved_at' => now(),
                'approved_by' => 1,
                'employer_id' => 1,
            ],
            // أضف المزيد لو حبيت
        ];

        DB::table('jobs')->insert($jobs);
    }
}

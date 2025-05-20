<?php

namespace Database\Seeders;

use App\Models\Employer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployerSeeder extends Seeder
{
    public function run()
    {
        Employer::factory()->count(50)->create();
    //     $employers = [
    //         [
    //             'user_id' => 1,
    //             'company_name' => 'Google Inc.',
    //             'industry' => 'Technology',
    //             'website' => 'https://www.google.com',
    //             'company_size' => '10,000+ employees',
    //             'company_logo' => 'https://kgo.googleusercontent.com/profile_vrt_raw_bytes_1587515358_10512.png',
    //             'company_description' => 'Google is a multinational technology company specializing in Internet-related services and products.',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'user_id' => 2,
    //             'company_name' => 'Microsoft Corporation',
    //             'industry' => 'Software',
    //             'website' => 'https://www.microsoft.com',
    //             'company_size' => '10,000+ employees',
    //             'company_logo' => 'https://seeklogo.com/images/M/microsoft-logo-4BA5F3F8C3-seeklogo.com.png',
    //             'company_description' => 'Microsoft develops, licenses, and supports a wide range of software products and services.',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'user_id' => 3,
    //             'company_name' => 'Netflix Inc.',
    //             'industry' => 'Entertainment',
    //             'website' => 'https://www.netflix.com',
    //             'company_size' => '12,000+ employees',
    //             'company_logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/69/Netflix_logo.svg',
    //             'company_description' => 'Netflix is a streaming service that offers a wide variety of award-winning TV shows, movies, anime, and more.',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'user_id' => 4,
    //             'company_name' => 'Airbnb Inc.',
    //             'industry' => 'Travel & Tourism',
    //             'website' => 'https://www.airbnb.com',
    //             'company_size' => '6,000+ employees',
    //             'company_logo' => 'https://seeklogo.com/images/A/airbnb-logo-2851D9409C-seeklogo.com.png',
    //             'company_description' => 'Airbnb is an online marketplace that connects people who want to rent out their homes with people who are looking for accommodations.',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]
    //     ];

    //     DB::table('employers')->insert($employers);
    }
}

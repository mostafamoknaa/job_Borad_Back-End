<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Google HR',
                'email' => 'employer1@example.com',
                'password' => Hash::make('password'),
                'role' => 'employer',
                'phone_number' => '01011112222',
                'address' => 'Mountain View, CA',
            ],
            [
                'name' => 'Microsoft HR',
                'email' => 'employer2@example.com',
                'password' => Hash::make('password'),
                'role' => 'employer',
                'phone_number' => '01122223333',
                'address' => 'Redmond, WA',
            ],
            [
                'name' => 'Netflix HR',
                'email' => 'employer3@example.com',
                'password' => Hash::make('password'),
                'role' => 'employer',
                'phone_number' => '01033334444',
                'address' => 'Los Gatos, CA',
            ],
            [
                'name' => 'Airbnb HR',
                'email' => 'employer4@example.com',
                'password' => Hash::make('password'),
                'role' => 'employer',
                'phone_number' => '01044445555',
                'address' => 'San Francisco, CA',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']], // Match on email
                array_merge($user, [
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}

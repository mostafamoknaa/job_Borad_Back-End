<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     */


    public function run()
{
    $categories = [
        ['name' => 'Graphics & Design', 'icon' => 'fas fa-pen-nib', 'positions' => 357],
        ['name' => 'Code & Programing', 'icon' => 'fas fa-code', 'positions' => 312],
        ['name' => 'Digital Marketing', 'icon' => 'fas fa-bullhorn', 'positions' => 297],
        ['name' => 'Video & Animation', 'icon' => 'fas fa-video', 'positions' => 247],
        ['name' => 'Music & Audio', 'icon' => 'fas fa-music', 'positions' => 204],
        ['name' => 'Account & Finance', 'icon' => 'fas fa-chart-line', 'positions' => 167],
        ['name' => 'Health & Care', 'icon' => 'fas fa-briefcase-medical', 'positions' => 125],
        ['name' => 'Data & Science', 'icon' => 'fas fa-database', 'positions' => 57],
    ];

    foreach ($categories as $category) {
        DB::table('categories')->updateOrInsert(
            ['name' => $category['name']], // unique
            [
                'icon' => $category['icon'],
                'positions' => $category['positions'],
                'updated_at' => now(),
                'created_at' => now(), // insert
            ]
        );
    }
}
}

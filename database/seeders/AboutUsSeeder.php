<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about_us')->insert([
            'title' => 'Our Company',
            'description' => 'We are committed to delivering the best services in the industry.',
            'mission' => 'To innovate and lead with integrity and passion.',
            'value' => 'Customer focus, Integrity, Innovation.',
            'value_image' => 'value_image.jpg',
            'vision' => 'To be the market leader in providing value-driven solutions.',
            'vision_image' => 'vision_image.jpg',
            'team' => 'Our team is composed of professionals from diverse fields working together.',
            'team_image' => 'team_image.jpg',
            'image' => 'company_image.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

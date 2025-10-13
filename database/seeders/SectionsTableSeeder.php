<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionsTableSeeder extends Seeder
{
    public function run(): void
    {
        Section::truncate();

        $sections = [
            ['name' => 'hero', 'sl' => 1, 'status' => 1],
            ['name' => 'services', 'sl' => 2, 'status' => 1],
            ['name' => 'about', 'sl' => 3, 'status' => 1],
            ['name' => 'gallery', 'sl' => 4, 'status' => 1],
            ['name' => 'cta', 'sl' => 5, 'status' => 1],
            ['name' => 'features', 'sl' => 6, 'status' => 1],
        ];

        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
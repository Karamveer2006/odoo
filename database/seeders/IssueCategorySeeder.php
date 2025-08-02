<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\IssueCategory;

class IssueCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Roads (Potholes, Obstructions)',
            'Lighting (Broken/Flickering Lights)',
            'Water Supply (Leaks, Low Pressure)',
            'Cleanliness (Overflowing Bins, Garbage)',
            'Public Safety (Open Manholes, Exposed Wiring)',
            'Obstructions (Fallen Trees, Debris)',
        ];

        foreach ($categories as $category) {
            IssueCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Issue;
use App\Models\User;
use App\Models\IssueCategory;

class IssueSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $category = IssueCategory::first();

        Issue::create([
            'user_id' => $user->id,
            'title' => 'Pothole on Main Street',
            'description' => 'There is a large pothole near the bus stop.',
            'category_id' => $category->id,
            'status' => 'Reported',
            'lat' => 28.6139,
            'lng' => 77.2090,
            'is_anonymous' => false
        ]);
    }
}

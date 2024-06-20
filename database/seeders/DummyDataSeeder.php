<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Note;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 10 notes. Category is created automatically.
        Note::factory()
            ->has(Category::factory())
            ->count(10)
            ->create();
    }
}

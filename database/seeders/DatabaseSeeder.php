<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Type::factory()->create([
            'name' => 'Admin / Owner',
        ]);
        Type::factory()->create([
            'name' => 'Author',
        ]);
        User::factory(1)->create([
            'type' => 1
        ]);
        User::factory(2)->create();

        // Setting::factory(1)->create();
        // Post::factory(120)->create();
    }
}

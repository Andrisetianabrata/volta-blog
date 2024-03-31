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
        // User::factory()->create([
        //     'name' => 'Andri Setianabrata',
        //     'username' => 'bratas',
        //     'type' => 1
        // ]);
        // User::factory()->create([
        //     'type' => 2
        // ]);
        // User::factory()->create([
        //     'type' => 3
        // ]);
        // Type::factory()->create([
        //     'name' => 'Owner / Super Admin'
        // ]);
        // Type::factory()->create([
        //     'name' => 'Admin',
        // ]);
        // Type::factory()->create([
        //     'name' => 'Author',
        // ]);

        // Setting::factory(1)->create();
        Post::factory(10)->create();
    }
}

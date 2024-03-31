<?php

namespace Database\Factories;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(mt_rand(4, 7));
        return [
            'author_id' => mt_rand(1,3),
            'category_id' => mt_rand(1,3),
            'post_title' => $title,
            'post_slug' => Str::slug($title),
            'post_content' => $this->faker->paragraph(20),
            'thumbnail' => '6606714072cb8-421271625-319952627706609-3045560889004853732-n.jpg'
        ];
    }
}

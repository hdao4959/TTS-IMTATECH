<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post_status;
use Illuminate\Database\Eloquent\Factories\Factory;
uSe Illuminate\Support\Str;

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
        $title = $this->faker->sentence();
        $sku  = Str::slug($title);
        return [
            'title' => $title,
            'slug' =>  $sku,
            'img_thumbnail' => fake()->imageUrl(800, 500, 'img_thumbnail'),
            'description' => fake()->sentence(),
            'content' => fake()->text(1000),
            'user_id'=>3,
            'view' => 1000,
            'category_id' => Category::inRandomOrder()->first()->id,
            'post_status_id' => Post_status::inRandomOrder()->first()->id
        ];
    }
}

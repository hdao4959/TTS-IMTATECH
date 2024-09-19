<?php
namespace Database\Factories;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Tag::class;
    public function definition(): array
    {
        $name = $this->faker->word();  // Tạo một từ ngẫu nhiên làm tên tag
        return [
            'name' => ucfirst($name),       // Tên của tag
            'slug' => Str::slug($name),     // Slug của tag
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePaths = Storage::disk()->allFiles('public/factory-images/');
        $randomImageUrl = '/'.substr($imagePaths[rand(0, count($imagePaths) - 1)], 7);

        return [
            'name'        => Str::title(substr($this->faker->sentence(random_int(1, 3)), 0, -1)),
            'description' => $this->faker->paragraph(6, true),
            'price'       => (float)random_int(1, 1000000) / 100,
            'imageUrl'    => $randomImageUrl,
        ];
    }
}

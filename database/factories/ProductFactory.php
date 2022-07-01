<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;


class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = UploadedFile::fake();

        return [

            'name'         => $this->faker->text(10),
            'manufacturer' => $this->faker->title,
            'description'  => $this->faker->paragraph,
            'price'        => $this->faker->randomFloat(2),
            'category_id'  => 1,
            'user_id'      => 1,
            'photo'        => $image->create('file.png'),

        ];

    }
}

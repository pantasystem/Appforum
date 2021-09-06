<?php

namespace Database\Factories;

use App\Models\Content;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Content::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this->faker->randomElement(['multiline', 'singleline']);
        $text;
        if($type == 'multiline') {
            $text= $this->faker->paragraph();
        }else{
            $text = $this->faker->sentence();
        }
        return [
            'text' => $text,
            'type' => $type,
            'name' => '説明' . $this->faker->randomNumber()
        ];
    }
}

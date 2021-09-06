<?php

namespace Database\Factories;

use App\Models\App;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = App::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'icon_path' => '/assets/default_app_icon.png',
            'name' => $this->faker->name(),
            'header_image_path' => '/assets/app_header.png',
            'text' => "## 概要\nこのアプリはダミーなアプリです\n## 機能一覧\n * ほげほげ \n * ぴよぴよ \n * ふがふが\n"
        ];
    }
}

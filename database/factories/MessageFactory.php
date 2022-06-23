<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Message;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->text,
            'capture_filter' => $this->faker->text,
            'capture_display' => $this->faker->text,
            'answer_table' => $this->faker->text,
            'answer_field' => $this->faker->text,
            'branch_id' => $this->faker->word,
        ];
    }
}

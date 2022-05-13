<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\QuestionState;

class QuestionStateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionState::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
            'question_id' => $this->faker->word,
            'state' => $this->faker->word,
            'response' => $this->faker->text,
            'last_changed' => $this->faker->dateTime(),
        ];
    }
}

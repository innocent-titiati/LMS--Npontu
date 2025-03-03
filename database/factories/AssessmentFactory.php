<?php

namespace Database\Factories;

use App\Models\Assessment;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssessmentFactory extends Factory
{
    protected $model = Assessment::class;

    public function definition()
    {
        return [
            'course_id' => Course::factory(), // Creates a related course
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['quiz', 'assignment', 'exam']),
            'total_marks' => $this->faker->numberBetween(20, 100),
        ];
    }
}

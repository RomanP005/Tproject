<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['Новый', 'В работе', 'Выполнена']),
            'priority' => $this->faker->numberBetween(1, 3),
            'deadline' => $this->faker->dateTimeBetween('now', '+7 days'),
            'project_id' => Project::factory(),
            'user_id' => User::factory(),
        ];
    }
}

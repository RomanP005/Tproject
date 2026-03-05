<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $users = User::factory(7)->create();

        $users->each(function ($user) {
            $projects = Project::factory(1)->create([
                'user_id' => $user->id,
            ]);
            $projects->each(function ($project) use ($user) {
                Task::factory(2)->create([
                    'project_id' => $project->id,
                    'user_id' => $user->id,
                ]);
            });
        });
    }
}

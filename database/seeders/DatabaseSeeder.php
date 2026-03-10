<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(7)->create();

        $users->each(function ($user) use ($users) {
            $projects = Project::factory(1)->create([
                'creator_id' => $user->id,
            ]);

            $projects->each(function ($project) use ($user, $users) {
                Task::factory(2)->create([
                    'project_id' => $project->id,
                    'user_id'    => $user->id,
                    'assignee_id' => $users->random()->id,
                ]);
            });
        });
    }
}

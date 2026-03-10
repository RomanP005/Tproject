<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{

    public function viewAny(User $user): bool
    {
        return false;
    }
    public function view(User $user, Project $project): bool
    {
        return $user->id === $project->creator_id;
    }

    public function update(User $user, Project $project)
    {
        return $user->id === $project->creator_id;
    }

    public function delete(User $user, Project $project)
    {

        return $user->id === $project->creator_id;
    }

    public function createTask(User $user, Project $project)
    {
        return $user->id === $project->creator_id;
    }
}

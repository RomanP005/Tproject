<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::where('creator_id', Auth::id())->get()
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('tasks.index', compact('projects'));
    }

    public function create()
    {
        $users = User::all();
        return view('projects.create', compact('users'));
    }

    public function store(ProjectRequest $request)
    {
        $project = Project::create([
            'title'       => $request['title'],
            'description' => $request['description'] ?? null,
            'creator_id'  => Auth::id(),
        ]);

        return redirect()->route('tasks.index', compact('project'));
    }

    public function show(Project $project)
    {
        if ($project->creator_id !== Auth::id()) {
            abort(403);
        }

        $tasks = $project->tasks()->with('assignee', 'user')->get();

        return view('projects.show', compact('project', 'tasks'));
    }

    public function edit(Project $project)
    {
        if ($project->creator_id !== Auth::id()) {
            abort(403);
        }

        return view('projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        if ($project->creator_id !== Auth::id()) {
            abort(403);
        }

        $project->update($request->validated());

        return redirect()->route('tasks.index');
    }

    public function destroy(Project $project)
    {
        if ($project->creator_id !== Auth::id()) {
            abort(403, 'Вы не можете удалить этот проект.');
        }

        $project->delete();

        return redirect()->route('tasks.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $priority = $request->get('priority');
        $deadline = $request->get('deadline');

        $tasks = Task::where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($priority, function ($query, $priority) {
                return $query->where('priority', $priority);
            })
            ->when($deadline, function ($query, $deadline) {
                return $query->whereDate('deadline', $deadline);
            })
            ->orderBy('status')
            ->orderBy('priority')
            ->orderBy('deadline')
            ->paginate(10)
            ->withQueryString();

        $projects = Project::where('creator_id', Auth::id())->get();

        return view('tasks.index', compact('tasks', 'projects', 'search', 'status', 'priority', 'deadline'));

    }

    public function create()
    {
        $projects = Project::all();
        $users = User::all();

        return view('tasks.create', compact(['projects', 'users']));
    }

    public function store(TaskRequest $request)

    {

        $data = $request->validated();

        $task = Task::create([
            'user_id' => Auth::id(),
            ...$data
        ]);

        if($task) {
            return redirect()->route('tasks.index');
        }
        abort(400);


    }

    public function show(Task $task)
    {
        if ($task->project->creator_id !== Auth::id() && $task->assignee_id !== Auth::id()) {
            abort(403);
        }

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {

        if ($task->project->creator_id !== Auth::id()) {
            abort(403);
        }

        $projects = Project::where('creator_id', Auth::id())->get();
        $users = User::all();

        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        if ($task->project->creator_id !== Auth::id()) {
            abort(403);
        }

        $task->update($request->validated());


        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        if ($task->project->creator_id !== Auth::id()) {
            abort(403, 'Вы не можете удалить эту задачу.');
        }

        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function start(Task $task)
    {

        if ($task->project->creator_id !== Auth::id()) {
            abort(403, 'Вы не можете изменять статус этой задачи.');
        }

        $task->status = StatusEnum::JOB;
        $task->save();

        return redirect()->back();
    }

    public function complete(Task $task)
    {
        if ($task->project->creator_id !== Auth::id()) {
            abort(403);
        }

        $task->status = StatusEnum::SUCCESS;
        $task->save();

        return redirect()->back();
    }
}

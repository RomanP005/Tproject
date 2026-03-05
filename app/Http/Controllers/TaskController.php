<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->orderBy('status')->orderBy('priority')->orderBy('deadline')->get();
        return view('tasks', ['tasks' => $tasks]);
    }

    public function create()
    {

    }
}

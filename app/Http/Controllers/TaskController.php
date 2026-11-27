<?php

namespace App\Http\Controllers;

use App\Mail\TaskCompletedMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where(function ($query) {
            $query->where('is_archived', false)
                ->orWhereNull('is_archived');
        })
        ->orderBy('task_date')
        ->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['pending', 'done'])],
            'task_date' => ['required', 'date'],
        ]);

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['pending', 'done'])],
            'task_date' => ['required', 'date'],
        ]);

        $shouldSendEmail =
            $task->status === 'pending' &&
            $validated['status'] === 'done';

        $task->update($validated);

        if ($shouldSendEmail) {
            Mail::to(
                env('TASK_NOTIFICATION_EMAIL', 'alezzandra@example.com')
            )->send(new TaskCompletedMail($task));
        }

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->update([
            'is_archived' => true,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task archived successfully.');
    }

    public function about()
    {
        return view('about.index');
    }
}
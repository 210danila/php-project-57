<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\{Gate, Log};

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = TaskStatus::all();
        return view('statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task_status = new TaskStatus();
        return view('statuses.create', compact('task_status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info(isset($request->user) ? $request->user->id : 'no user');
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses'
        ]);

        $status = new TaskStatus($data);
        $status->save();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskStatus $task_status)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $task_status)
    {
        return view('statuses.edit', compact('task_status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskStatus $task_status)
    {
        // if (Gate::denies('update-status', $task_status)) {
        //     return redirect()->route('login');
        // }
        $data = $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('task_statuses')->ignore($task_status->id)
            ]
        ]);

        $task_status->fill($data);
        $task_status->save();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, TaskStatus $task_status)
    {
        Log::debug('del');
        if ($task_status) {
            $task_status->delete();
        }
        return redirect()->route('task_statuses.index');
    }
}

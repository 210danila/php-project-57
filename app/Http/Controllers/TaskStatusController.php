<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\{Gate, DB};
use App\Http\Requests\TaskStatusRequest;

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
        Gate::authorize('status');
        $task_status = new TaskStatus();
        return view('statuses.create', compact('task_status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('status');
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses'
        ]);

        $status = new TaskStatus($data);
        $status->save();
        flash(__('flash.status_created'))->success();

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
        Gate::authorize('status');
        return view('statuses.edit', compact('task_status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskStatus $task_status)
    {
        Gate::authorize('status');
        $data = $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('task_statuses')->ignore($task_status->id)
            ]
        ]);

        $task_status->fill($data);
        $task_status->save();
        flash(__('flash.status_edited'))->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, TaskStatus $task_status)
    {
        Gate::authorize('status');
        if (
            DB::table('task_statuses')->where('id', $task_status->id)->exists() and
            DB::table('tasks')->where('status_id', $task_status->id)->count() === 0
        ) {
            $task_status->delete();
            flash(__('flash.status_deleted'))->success();
        } else {
            flash(__('flash.status_not_deleted'))->error();
        }
        return redirect()->route('task_statuses.index');
    }
}

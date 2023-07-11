<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\TaskStatusRequest;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class, 'taskStatus');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = TaskStatus::paginate(15);
        return view('task_statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task_status = new TaskStatus();
        return view('task_statuses.create', compact('task_status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStatusRequest $request)
    {
        $data = $request->validated();
        $status = new TaskStatus($data);
        $status->save();
        flash(__('flash.status_created'))->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $task_status)
    {
        return view('task_statuses.edit', compact('task_status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskStatusRequest $request, TaskStatus $task_status)
    {
        $data = $request->validated();
        $task_status->fill($data);
        $task_status->save();
        flash(__('flash.status_edited'))->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $task_status)
    {
        if ($task_status->tasks()->exists()) {
            flash(__('flash.status_not_deleted'))->error();
            return back();
        }

        $task_status->delete();
        flash(__('flash.status_deleted'))->success();

        return redirect()->route('task_statuses.index');
    }
}

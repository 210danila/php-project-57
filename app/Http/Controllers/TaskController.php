<?php

namespace App\Http\Controllers;

use App\Models\{Task, TaskStatus, User, Label};
use Illuminate\Http\Request;
use App\Http\Requests\{TaskStoreRequest, TaskUpdateRequest};
use Illuminate\Support\Facades\{Auth, Gate, DB};
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterQueries = $request->query('filter');
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id')
            ])
            ->orderBy('id')
            ->paginate(15);
        return view('tasks.index', compact('statuses', 'users', 'filterQueries', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Task::class);
        $task = new Task();
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $allLabels = Label::pluck('name', 'id');
        return view('tasks.create', compact('task', 'statuses', 'users', 'allLabels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $data = $request->validated();
        $task = Auth::user()->createdTasks()->make($data);
        $task->save();
        if (isset($data['labels'])) {
            $labels = collect($data['labels'])->whereNotNull()->all();
            $task->labels()->attach($labels);
        }

        flash(__('flash.task_created'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task->load('labels');
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        Gate::authorize('update', Task::class);
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id')->all();
        $allLabels = Label::pluck('name', 'id');
        $selectedLabels = $task->labels()->pluck('label_id')->all();
        return view('tasks.edit', compact('task', 'statuses', 'users', 'allLabels', 'selectedLabels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $data = $request->validated();
        $task->fill($data);
        $task->save();
        $task->labels()->detach();
        if (isset($data['labels'])) {
            $labels = collect($data['labels'])->whereNotNull()->all();
            $task->labels()->attach($labels);
        }

        flash(__('flash.task_updated'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);
        $task->delete();
        flash(__('flash.task_deleted'))->success();
        return redirect()->route('tasks.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\{Task, TaskStatus, User, Label};
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
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
        $statuses = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();

        if (!is_null($filterQueries)) {
            $tasks = Task::orderBy('id')->paginate(15);
            return view('tasks.index', compact('statuses', 'users', 'filterQueries', 'tasks'));
        }
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id')
            ])
            ->paginate(15);
        return view('tasks.index', compact('statuses', 'users', 'filterQueries', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('store-or-update-task');
        $task = new Task();
        $statuses = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $allLabels = Label::pluck('name', 'id')->all();
        $selectedLabels = [];
        return view('tasks.create', compact('task', 'statuses', 'users', 'allLabels', 'selectedLabels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $data['created_by_id'] = Auth::id();
        $task = new Task($data);
        $task->save();
        if (isset($data['labels'])) {
            $data['labels'] = array_filter($data['labels'], fn($label) => !is_null($label));
            $task->labels()->attach($data['labels']);
        }

        flash(__('flash.task_created'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $labels = $task->labels()->get();
        return view('tasks.show', compact('task', 'labels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        Gate::authorize('store-or-update-task');
        $statuses = TaskStatus::pluck('name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $allLabels = Label::all()->pluck('name', 'id')->all();
        $selectedLabels = collect($task->labels()->get())->pluck('id')->all();
        return view('tasks.edit', compact('task', 'statuses', 'users', 'allLabels', 'selectedLabels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $task->fill($data);
        $task->save();
        $task->labels()->detach();
        if (isset($data['labels'])) {
            $data['labels'] = array_filter($data['labels'], fn($label) => !is_null($label));
            $task->labels()->attach($data['labels']);
        }

        flash(__('flash.task_updated'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete-task', $task);
        if (DB::table('tasks')->where('id', $task->id)->exists()) {
            $task->delete();
            flash(__('flash.task_deleted'))->success();
        } else {
            flash(__('flash.task_not_deleted'))->error();
        }
        return redirect()->route('tasks.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\{Task, TaskStatus, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Gate, DB};

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterQueries = $request->query('filter');
        $statuses = TaskStatus::all()->pluck('name', 'id')->all();
        $users = User::all()->pluck('name', 'id')->all();

        if (!$filterQueries) {
            $tasks = Task::orderBy('id')->paginate(15);
            return view('tasks.index', compact('statuses', 'users', 'filterQueries', 'tasks'));
        }
        $filterClauses = collect($filterQueries)
            ->filter(fn($filterValue) => !empty($filterValue))
            ->map(fn($filterValue, $columnName) => [$columnName, $filterValue])
            ->values()
            ->toArray();

        $tasks = Task::where($filterClauses)->orderBy('id')->paginate(15);
        return view('tasks.index', compact('statuses', 'users', 'filterQueries', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('store-task');
        $task = new Task();
        $statuses = TaskStatus::all()->pluck('name', 'id')->all();
        $users = User::all()->pluck('name', 'id')->all();
        return view('tasks.create', compact('task', 'statuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('store-task');
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable'
        ]);
        $data['created_by_id'] = Auth::id();

        $task = new Task($data);
        $task->save();

        flash(__('flash.task_created'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        Gate::authorize('update-task');
        $statuses = TaskStatus::all()->pluck('name', 'id')->all();
        $users = User::all()->pluck('name', 'id')->all();
        return view('tasks.edit', compact('task', 'statuses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        Gate::authorize('update-task');
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable'
        ]);

        $task->fill($data);
        $task->save();

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

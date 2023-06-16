<?php

namespace App\Http\Controllers;

use App\Models\{Label, Task};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Gate};
use Carbon\Carbon;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::all();
        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('label');
        $label = new Label();
        return view('labels.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('label');
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable'
        ]);

        $label = new Label($data);
        $label->save();
        flash(__('flash.label_created'))->success();

        return redirect()->route('labels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        Gate::authorize('label');
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        Gate::authorize('label');
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable'
        ]);

        $label->fill($data);
        $label->save();
        flash(__('flash.label_updated'))->success();

        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        Gate::authorize('label');
        if (
            DB::table('labels')->where('id', $label->id)->exists() and
            $label->tasks()->count() === 0
        ) {
            $label->delete();
            flash(__('flash.label_deleted'))->success();
        } else {
            flash(__('flash.label_not_deleted'))->error();
        }
        return redirect()->route('labels.index');
    }
}

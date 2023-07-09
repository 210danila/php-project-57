<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\LabelRequest;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::paginate(15);
        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Label::class);
        $label = new Label();
        return view('labels.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LabelRequest $request)
    {
        $data = $request->validated();
        $label = new Label($data);
        $label->save();
        flash(__('flash.label_created'))->success();

        return redirect()->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        Gate::authorize('update', Label::class);
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LabelRequest $request, Label $label)
    {
        $data = $request->validated();
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
        Gate::authorize('delete', Label::class);
        if ($label->tasks()->exists()) {
            flash(__('flash.label_not_deleted'))->error();
            return back();
        }

        $label->delete();
        flash(__('flash.label_deleted'))->success();

        return redirect()->route('labels.index');
    }

    public function show(Label $label)
    {
        //
    }
}

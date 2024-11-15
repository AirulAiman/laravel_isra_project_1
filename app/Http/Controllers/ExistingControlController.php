<?php

namespace App\Http\Controllers;

use App\Models\ExistingControl;
use App\Models\ControlGroup;
use Illuminate\Http\Request;

class ExistingControlController extends Controller
{
    public function index()
    {
        $controls = ExistingControl::with('controlGroup')->get();
        return view('existing_controls.index', compact('controls'));
    }

    public function create()
    {
        $groups = ControlGroup::all();
        return view('existing_controls.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'control_group_id' => 'required|exists:control_groups,id',
            'status' => 'required|in:Active,Inactive'
        ]);

        ExistingControl::create($validated);

        return redirect()->route('existing-controls.index')
            ->with('success', 'Control created successfully.');
    }

    public function edit(ExistingControl $existingControl)
    {
        $groups = ControlGroup::all();
        return view('existing_controls.edit', compact('existingControl', 'groups'));
    }

    public function update(Request $request, ExistingControl $existingControl)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'control_group_id' => 'required|exists:control_groups,id',
            'status' => 'required|in:Active,Inactive'
        ]);

        $existingControl->update($validated);

        return redirect()->route('existing-controls.index')
            ->with('success', 'Control updated successfully.');
    }

    public function destroy(ExistingControl $existingControl)
    {
        $existingControl->delete();

        return redirect()->route('existing-controls.index')
            ->with('success', 'Control deleted successfully.');
    }
}
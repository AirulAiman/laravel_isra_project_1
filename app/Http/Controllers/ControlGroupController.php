<?php

namespace App\Http\Controllers;

use App\Models\ControlGroup;
use App\Models\ExistingControl;
use Illuminate\Http\Request;

class ControlGroupController extends Controller
{
    public function index()
    {
        $groups = ControlGroup::withCount('controls')->get();
        return view('control_groups.index', compact('groups'));
    }

    public function create()
    {
        return view('control_groups.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:control_groups',
            // 'description' => 'required|string'
        ]);

        ControlGroup::create($validated);

        return redirect()->route('control-groups.index')
            ->with('success', 'Control Group created successfully.');
    }

    public function edit(ControlGroup $controlGroup)
    {
        return view('control_groups.edit', compact('controlGroup'));
    }

    public function update(Request $request, ControlGroup $controlGroup)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:control_groups,name,' . $controlGroup->id,
            // 'description' => 'required|string'
        ]);

        $controlGroup->update($validated);

        return redirect()->route('control-groups.index')
            ->with('success', 'Control Group updated successfully.');
    }

    public function destroy(ControlGroup $controlGroup)
    {
        if ($controlGroup->controls()->count() > 0) {
            return redirect()->route('control-groups.index')
                ->with('error', 'Cannot delete group that has controls assigned to it.');
        }

        $controlGroup->delete();

        return redirect()->route('control-groups.index')
            ->with('success', 'Control Group deleted successfully.');
    }

    public function show(ControlGroup $controlGroup)
    {
        $controls = $controlGroup->controls;
        $availableControls = ExistingControl::whereNull('control_group_id')
            ->orWhere('control_group_id', $controlGroup->id)
            ->get();
            
        return view('control_groups.show', compact('controlGroup', 'controls', 'availableControls'));
    }

    public function updateControls(Request $request, ControlGroup $controlGroup)
    {
        $validated = $request->validate([
            'control_ids' => 'required|array',
            'control_ids.*' => 'exists:existing_controls,id'
        ]);

        // Update all controls to remove them from this group
        ExistingControl::where('control_group_id', $controlGroup->id)
            ->update(['control_group_id' => null]);

        // Assign selected controls to this group
        if (!empty($validated['control_ids'])) {
            ExistingControl::whereIn('id', $validated['control_ids'])
                ->update(['control_group_id' => $controlGroup->id]);
        }

        return redirect()->route('control-groups.show', $controlGroup)
            ->with('success', 'Controls updated successfully.');
    }
}
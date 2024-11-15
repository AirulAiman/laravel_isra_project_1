<?php

namespace App\Http\Controllers;

use App\Models\ControlGroup;
use App\Models\ExistingControl;
use Illuminate\Http\Request;

class ControlManagementController extends Controller
{
    public function index()
    {
        $groups = ControlGroup::withCount('controls')->get();
        $controls = ExistingControl::with('controlGroup')->get();
        return view('controls-management.index', compact('groups', 'controls'));
    }

    public function storeGroup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:control_groups',
            // 'description' => 'required|string'
        ]);

        ControlGroup::create($validated);

        return redirect()->route('controls-management.index')
            ->with('success', 'Control Group created successfully.');
    }

    public function updateGroup(Request $request, ControlGroup $controlGroup)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:control_groups,name,' . $controlGroup->id,
            // 'description' => 'required|string'
        ]);

        $controlGroup->update($validated);

        return redirect()->route('controls-management.index')
            ->with('success', 'Control Group updated successfully.');
    }

    public function destroyGroup(ControlGroup $controlGroup)
    {
        if ($controlGroup->controls()->count() > 0) {
            return redirect()->route('controls-management.index')
                ->with('error', 'Cannot delete group that has controls assigned to it.');
        }

        $controlGroup->delete();

        return redirect()->route('controls-management.index')
            ->with('success', 'Control Group deleted successfully.');
    }

    public function storeControl(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'control_group_id' => 'required|exists:control_groups,id',
            // 'status' => 'required|in:Active,Inactive'
        ]);

        ExistingControl::create($validated);

        return redirect()->route('controls-management.index')
            ->with('success', 'Control created successfully.');
    }

    public function updateControl(Request $request, ExistingControl $existingControl)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'control_group_id' => 'required|exists:control_groups,id',
            // 'status' => 'required|in:Active,Inactive'
        ]);

        $existingControl->update($validated);

        return redirect()->route('controls-management.index')
            ->with('success', 'Control updated successfully.');
    }

    public function destroyControl(ExistingControl $existingControl)
    {
        $existingControl->delete();

        return redirect()->route('controls-management.index')
            ->with('success', 'Control deleted successfully.');
    }
}
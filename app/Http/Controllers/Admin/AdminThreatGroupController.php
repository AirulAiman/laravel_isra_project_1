<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThreatGroup;

class AdminThreatGroupController extends Controller
{
    public function create()
    {
        $groups = ThreatGroup::all();
        return view('admin.threat-profile.groups.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        ThreatGroup::create($request->all());
        return redirect()->route('threats.view')->with('success', 'Threat Group created successfully.');
    }

    public function edit($id)
    {
        $group = ThreatGroup::findOrFail($id);
        return view('admin.threat-profile.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        $group = ThreatGroup::findOrFail($id);
        $group->update($request->all());
        return redirect()->route('threats.index')->with('success', 'Threat Group updated successfully.');

    }

    public function destroy($id)
    {
        $group = ThreatGroup::findOrFail($id);
        $group->delete();
        return redirect()->route('threats.view')->with('success', 'Threat Group deleted successfully.');
    }
}

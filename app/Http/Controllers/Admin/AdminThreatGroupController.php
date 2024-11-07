<?php

namespace App\Http\Controllers;

use App\Models\ThreatGroup;
use Illuminate\Http\Request;

class AdminThreatGroupController extends Controller
{
    public function create()
    {
        return view('admin.threat-profile.groups.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        ThreatGroup::create($request->all());
        return redirect()->route('threats.index')->with('success', 'Threat Group created successfully.');
    }

    public function edit($id)
    {
        $group = ThreatGroup::findOrFail($id);
        return view('user.profile.threats.groups.edit', compact('group'));
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
        return redirect()->route('threats.index')->with('success', 'Threat Group deleted successfully.');
    }
}

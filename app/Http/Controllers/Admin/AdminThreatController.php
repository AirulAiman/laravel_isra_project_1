<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Threat;
use App\Models\ThreatGroup;

class AdminThreatController extends Controller
{
    public function newView()
    {
        $groups = ThreatGroup::with('threats')->get();
        $groupies = ThreatGroup::all();
        $threats = Threat::all();

        return view('admin.tthreat-profile.index', compact('groups', 'groupies', 'threats'));
    }
    public function index()
    {
        $groups = ThreatGroup::with('threats')->get();
        $groupies = ThreatGroup::all();
        return view('admin.threat-profile.index', compact('groups', 'groupies'));
    }

    public function create()
    {
        $groups = ThreatGroup::all();
        return view('admin.threat-profile.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'threat_group_id' => 'required'
        ]);

        Threat::create($request->all());
        return redirect()->route('threats.view')->with('success', 'Threat created successfully.');
    }

    public function edit($id)
    {
        $threat = Threat::findOrFail($id);
        $groups = ThreatGroup::all();
        return view('admin.threat-profile.edit', compact('threat', 'groups'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'threat_group_id' => 'required'
        ]);

        $threat = Threat::findOrFail($id);
        $threat->update($request->all());

        return redirect()->route('threats.view')->with('success', 'Threat updated successfully.');
    }

    public function destroy($id)
    {
        $threat = Threat::findOrFail($id);
        $threat->delete();
        return redirect()->route('threats.view')->with('success', 'Threat deleted successfully.');
    }

    public function getThreatsByGroup($groupId)
    {
        $threats = Threat::where('threat_group_id', $groupId)->get();
        return view('partials.threats', compact('threats'));
    }
}

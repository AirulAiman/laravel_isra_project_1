<?php

namespace App\Http\Controllers;

use App\Models\Threat;
use App\Models\ThreatGroup;
use Illuminate\Http\Request;

class ThreatController extends Controller
{
    public function index()
    {
        $groups = ThreatGroup::with('threats')->get();
        return view('user.profile.threats.index', compact('groups'));
    }

    public function create()
    {
        $groups = ThreatGroup::all();
        return view('user.profile.threats.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'threat_group_id' => 'required'
        ]);

        Threat::create($request->all());
        return redirect()->route('threats.index')->with('success', 'Threat created successfully.');
    }

    public function edit($id)
    {
        $threat = Threat::findOrFail($id);
        $groups = ThreatGroup::all();
        return view('user.profile.threats.edit', compact('threat', 'groups'));
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
        return redirect()->route('threats.index')->with('success', 'Threat updated successfully.');
    }

    public function destroy($id)
    {
        $threat = Threat::findOrFail($id);
        $threat->delete();
        return redirect()->route('threats.index')->with('success', 'Threat deleted successfully.');
    }
    public function getThreatsByGroup($groupId)
    {
        $threats = Threat::where('threat_group_id', $groupId)->get();
        $options = '<option value="">Select Threat</option>';
        foreach ($threats as $threat) {
            $options .= '<option value="' . $threat->id . '">' . $threat->name . '</option>';
        }
        return $options;
    }
    

}
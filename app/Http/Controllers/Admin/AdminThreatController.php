<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Threat;
use App\Models\ThreatGroup;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator; 

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
        try {
            // Find the threat by ID
            $threat = Threat::findOrFail($id);

            // Extract only the fields present in the request
            $input = $request->only(['name', 'description', 'threat_group_id']);

            // Remove fields with null or empty values
            $input = array_filter($input, function ($value) {
                return $value !== null && $value !== '';
            });

            // If no data provided, return with an error message
            if (empty($input)) {
                return redirect()->back()->with('error', 'No data provided to update.');
            }

            // Define validation rules dynamically based on input
            $rules = [];
            if (array_key_exists('name', $input)) {
                $rules['name'] = 'required|string|max:255';
            }
            if (array_key_exists('description', $input)) {
                $rules['description'] = 'nullable|string';
            }
            if (array_key_exists('threat_group_id', $input)) {
                $rules['threat_group_id'] = 'exists:threat_groups,id';
            }

            // Validate only the provided fields
            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                return redirect()->back()
                                 ->withErrors($validator)
                                 ->withInput();
            }

            $validatedData = $validator->validated();

            // Update only the fields provided
            $threat->update($validatedData);

            return redirect()->route('threats.view')->with('success', 'Threat updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            // Return with error message
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
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

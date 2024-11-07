<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Vulnerability;
use App\Models\VulnerabilityGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class VulnController extends Controller
{
    public function newView()
    {
        $groups = VulnerabilityGroup::with('vulnerabilities')->get();
        $groupies = VulnerabilityGroup::all();
        $vulns = Vulnerability::all();

        return view('admin.vulnn-profile.index', compact('groups', 'groupies', 'vulns'));
    }

    public function index()
    {
        $groups = VulnerabilityGroup::with('vulnerabilities')->get();
        return view('user.profile.Vulnerability.index', compact('groups'));
    }

    public function create()
    {
        $groups = VulnerabilityGroup::all();
        return view('user.profile.Vulnerability.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'vulnerability_group_id' => 'required'
        ]);

        Vulnerability::create($request->all());
        return redirect()->route('vulnerabilities.view')->with('success', 'Vulnerability created successfully.');
    }

    public function edit($id)
    {
        $vulnerability = Vulnerability::findOrFail($id);
        $groups = VulnerabilityGroup::all();
        return view('user.profile.Vulnerability.edit', compact('vulnerability', 'groups'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Find the threat by ID
            $threat = Vulnerability::findOrFail($id);

            // Extract only the fields present in the request
            $input = $request->only(['name', 'description', 'vulnerability_group_id']);

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
                $rules['name'] = 'nullable|string|max:255';
            }
            if (array_key_exists('description', $input)) {
                $rules['description'] = 'nullable|string';
            }
            if (array_key_exists('vulnerability_group_id', $input)) {
                $rules['vulnerability_group_id'] = 'exists:vulnerability_groups,id';
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

            return redirect()->route('vulnerabilities.view')->with('success', 'Vulnerability updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            // Return with error message
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }

    public function destroy($id)
    {
        $vulnerability = Vulnerability::findOrFail($id);
        $vulnerability->delete();
        return redirect()->route('vulnerabilities.view')->with('success', 'Vulnerability deleted successfully.');
    }

    public function getVulnerabilitiesByGroup($groupId)
{
    $vulnerabilities = Vulnerability::where('vulnerability_group_id', $groupId)->get();
    return view('partials.vulnerabilities', compact('vulnerabilities')); // Create this view for vulnerabilities
}
}

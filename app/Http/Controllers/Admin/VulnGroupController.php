<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VulnerabilityGroup;
use Illuminate\Http\Request;

class VulnGroupController extends Controller
{
    public function create()
    {
        return view('user.profile.Vulnerability.groups.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        VulnerabilityGroup::create($request->all());
        return redirect()->route('vulnerabilities.view')->with('success', 'Vulnerability Group created successfully.');
    }

    public function edit($id)
    {
        $group = VulnerabilityGroup::findOrFail($id);
        return view('user.profile.Vulnerability.groups.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        $group = VulnerabilityGroup::findOrFail($id);
        $group->update($request->all());
        return redirect()->route('vulnerabilities.index')->with('success', 'Vulnerability Group updated successfully.');
    }

    public function destroy($id)
    {
        $group = VulnerabilityGroup::findOrFail($id);
        $group->delete();
        return redirect()->route('vulnerabilities.index')->with('success', 'Vulnerability Group deleted successfully.');
    }
}

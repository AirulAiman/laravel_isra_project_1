<?php

namespace App\Http\Controllers\Admin;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('organization.index', compact('organizations'));
    }

    public function view()
    {
        $organizations = Organization::all();
        return view('admin.organizations.main', compact('organizations'));
    }

    // edit starts from this function
    public function edit($org_id)
    {
        $organization = Organization::findOrFail($org_id);
        return view('organization.edit', compact('organization'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'org_name' => 'required|string|max:255',
            'org_logo' => 'nullable|image|max:2048',
        ]);

        $organization = new Organization;
        $organization->org_name = $validated['org_name'];

        if ($request->hasFile('org_logo')) {
            $path = $request->file('org_logo')->store('logos', 'public');
            $organization->org_logo = basename($path); // Store only the filename
        }

        $organization->org_id = mt_rand(100000, 900000);
        $organization->save();

        return redirect()->back();
    }


    // to this function
    public function update(Request $request, $org_id)
    {
        $request->validate([
            'org_name' => 'required|string|max:255',
            'org_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $organization = Organization::findOrFail($org_id);
        $organization->org_name = $request->org_name;

        // Check if a new logo was uploaded
        if ($request->hasFile('org_logo')) {
            // Delete the old logo if it exists
            if ($organization->org_logo) {
                Storage::disk('public')->delete('logos/' . $organization->org_logo);
            }

            // Store the new logo
            $path = $request->file('org_logo')->store('logos', 'public');
            $organization->org_logo = basename($path);  // Store only the filename
        }

        $organization->save();

        return redirect()->route('organizations.index')->with('success', 'Organization updated successfully!');
    }

    public function destroy($org_id)
    {
        $organization = Organization::findOrFail($org_id);

        // Optionally delete the logo file from storage
        if ($organization->org_logo) {
            Storage::disk('public')->delete($organization->org_logo);
        }

        $organization->delete();

        return redirect()->route('organizations.index')->with('success', 'Organization deleted successfully!');
    }
}

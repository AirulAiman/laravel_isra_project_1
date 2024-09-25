<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Log;

class TestOrganizationController extends Controller
{
    // ====================================
    // READ
    // ====================================
    public function view()
    {
        Debugbar::info('Organizations View');
        $organizations = Organization::all();
        return view('admin.organizations.main', compact('organizations'));
    }

    // ====================================
    // CREATE
    // ====================================
    public function create(Request $request)
    {
        Log::info('Creating organization');
        try {
            Log::info('Validating request');
            $validated = $request->validate([
                'org_name' => 'required|string|max:255',
                'org_logo' => 'nullable|image|max:2048',
            ]);

            Log::info('Request validated', $validated);

            $organization = new Organization([
                'org_name' => $validated['org_name'],
<<<<<<< Updated upstream
=======
                'org_id' => random_int(10, 90), // Ensure org_id is set here
>>>>>>> Stashed changes
            ]);

            Log::info('Organization instance created', ['organization' => $organization]);

            if ($request->hasFile('org_logo')) {
                $organization->org_logo = $request->file('org_logo')->store('org_logo', 'public');
                Log::info('Organization logo stored', ['org_logo' => $organization->org_logo]);
            }

            $organization->save();
            Log::info('Organization saved to database', ['organization' => $organization]);

            return redirect()->back()->with('success', 'Organization created successfully.');
        } catch (\Exception $e) {
<<<<<<< Updated upstream
            Log::error($e->getMessage());
=======
            Log::error('Error occurred while creating organization', ['exception' => $e->getMessage()]);
>>>>>>> Stashed changes
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the organization.']);
        }
    }

    // ====================================
    // UPDATE
    // ====================================
    public function update(Request $request, $org_id)
    {
        $organization = Organization::find($org_id);
        if (!$organization) {
            return redirect()->back()->withErrors(['error' => 'Organization not found']);
        }

        $validated = $request->validate([
            'org_name' => 'required|string|max:255',
        ]);

        $organization->org_name = $validated['org_name'];

        if ($request->hasFile('org_logo')) {
            $organization->org_logo = $this->handleImageUpload($request, 'org_logo');
        }

        $organization->save();
        return redirect()->back()->with('success', 'Organization updated successfully.');
    }

    private function handleImageUpload(Request $request, $fieldName)
    {
        if ($request->hasFile($fieldName)) {
            return $request->file($fieldName)->store('org_logo', 'public');
        }
        return null;
    }
}

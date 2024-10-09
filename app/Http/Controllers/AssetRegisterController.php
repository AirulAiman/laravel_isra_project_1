<?php

namespace App\Http\Controllers;

use App\Models\AssetRegister;
use App\Models\RiskAssessment; // Import RiskAssessment model
use Illuminate\Http\Request;

class AssetRegisterController extends Controller
{
    // Display a list of assets
    public function index()
    {
        $assets = AssetRegister::all();  // Fetch the assets from the model
        return view('user.asset_register.index', compact('assets'));
    }

    // Show form to add an asset
    public function create()
    {
        return view('user.asset_register.create');
    }

    // Store new asset in the database
    public function store(Request $request)
{
    $validated = $request->validate([
        'asset_name' => 'required|string|max:255',
        'asset_desc' => 'nullable|string',
        'asset_serial_no' => 'required|string|max:255',
        'asset_category' => 'required|in:Process,Data & Information,Hardware,Software,Service,People,Premise',
        'asset_qty' => 'required|integer',
        'asset_owner' => 'required|string|max:255',
        'asset_location' => 'nullable|string|max:255',
    ]);
        // Create the asset
        $asset = AssetRegister::create($validated);

        // Automatically create a risk assessment for the new asset
        RiskAssessment::create([
            'asset_id' => $asset->id, // Use $asset->id instead of $asset->asset_id
            'threat_group_id' => null,
            'threat_id' => null,
            'vulnerability_group_id' => null,
            'vulnerability_id' => null,
            'confidentiality' => 0,
            'integrity' => 0,
            'availability' => 0,
            'personnel' => 'N/A',
            'start_time' => now(),
            'likelihood' => 'Low',
            'impact' => 'Low',
            'risk_level' => 'Acceptable',
            'risk_owner' => $validated['asset_owner'],
            'mitigation_option' => 'None',
        ]);
    
        return redirect()->route('assets.index')->with('success', 'Asset added successfully');
    }
    // Show form to edit an asset
    public function edit($id)
    {
        $asset = AssetRegister::findOrFail($id);
        return view('user.asset_register.edit', compact('asset'));
    }

    // Update asset information
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'asset_name' => 'required|string|max:255',
            'asset_desc' => 'nullable|string',
            'asset_serial_no' => 'required|string|max:255',
            'asset_category' => 'required|in:Process,Data & Information,Hardware,Software,Service,People,Premise',
            'asset_qty' => 'required|integer',
            'asset_owner' => 'required|string|max:255',
            'asset_location' => 'nullable|string|max:255',
        ]);

        $asset = AssetRegister::findOrFail($id);
        $asset->update($validated);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully');
    }

    // Delete an asset
    public function destroy($id)
    {
        $asset = AssetRegister::findOrFail($id);
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully');
    }
}

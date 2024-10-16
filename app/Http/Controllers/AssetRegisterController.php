<?php

namespace App\Http\Controllers;

use App\Models\AssetRegister;
use App\Models\RiskAssessment;
use Illuminate\Http\Request;

class AssetRegisterController extends Controller
{
    public function index()
    {
        $assets = AssetRegister::all();
        return view('asset_register.index', compact('assets'));
    }

    public function create()
    {
        return view('asset_register.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_name' => 'required|string|max:255',
            'asset_serial_no' => 'required|string|max:255',
            'asset_category' => 'required|in:Process,Data & Information,Hardware,Software,Service,People,Premise',
            'asset_qty' => 'required|integer|min:1',
            'asset_owner' => 'required|string|max:255',
            'asset_location' => 'nullable|string|max:255',
        ]);

        $asset = AssetRegister::create($request->all());

        // Create corresponding Risk Assessment record
        RiskAssessment::create([
            'asset_id' => $asset->id,
            // other fields can be set to default or specific logic
            'confidentiality' => 0,
            'integrity' => 0,
            'availability' => 0,
            'likelihood' => 'Low',
            'impact' => 'Low',
            'risk_level' => 'Acceptable',
            // set any other default values as needed
        ]);

        return redirect()->route('asset_register.index')->with('success', 'Asset registered successfully!');
    }

    public function edit(AssetRegister $asset)
    {
        return view('asset_register.edit', compact('asset'));
    }

    public function update(Request $request, AssetRegister $asset)
    {
        $request->validate([
            'asset_name' => 'required|string|max:255',
            'asset_serial_no' => 'required|string|max:255',
            'asset_category' => 'required|in:Process,Data & Information,Hardware,Software,Service,People,Premise',
            'asset_qty' => 'required|integer|min:1',
            'asset_owner' => 'required|string|max:255',
            'asset_location' => 'nullable|string|max:255',
        ]);

        $asset->update($request->all());

        return redirect()->route('asset_register.index')->with('success', 'Asset updated successfully!');
    }

    public function destroy(AssetRegister $asset)
    {
        $asset->delete();
        return redirect()->route('asset_register.index')->with('success', 'Asset deleted successfully!');
    }
}

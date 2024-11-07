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
            'asset_name' => 'required|string',
            'asset_serial_no' => 'required|string',
            'asset_category' => 'required|string',
            'asset_qty' => 'required|integer',
            'asset_owner' => 'required|string',
        ]);

        $asset = AssetRegister::create($request->all());

        // Automatically create a RiskAssessment entry for the new asset
        RiskAssessment::create([
            'asset_id' => $asset->id,
            'personnel' => 'N/A',
            'risk_level' => 'Low',
            'start_time' => now(),
        ]);

        return redirect()->route('asset_register.index')->with('success', 'Asset registered and risk assessment created.');
    }

    public function edit(AssetRegister $asset_register)
    {
        return view('asset_register.edit', compact('asset_register'));
    }

    public function update(Request $request, AssetRegister $asset_register)
    {
        $request->validate([
            'asset_name' => 'required|string',
            'asset_serial_no' => 'required|string',
            'asset_category' => 'required|string',
            'asset_qty' => 'required|integer',
            'asset_owner' => 'required|string',
        ]);

        $asset_register->update($request->all());

        return redirect()->route('asset_register.index')->with('success', 'Asset updated successfully.');
    }

    public function destroy(AssetRegister $asset_register)
    {
        $asset_register->delete();
        return redirect()->route('asset_register.index')->with('success', 'Asset deleted successfully.');
    }
}

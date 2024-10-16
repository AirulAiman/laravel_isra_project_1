<?php

namespace App\Http\Controllers;

use App\Models\RiskAssessment;
use App\Models\AssetRegister;
use App\Models\Threat;
use App\Models\ThreatGroup;
use App\Models\Vulnerability;
use App\Models\VulnerabilityGroup;
use Illuminate\Http\Request;

class RiskAssessmentController extends Controller
{
    public function index()
    {
        // Fetch risk assessments with the necessary relationships
        $riskAssessments = RiskAssessment::with(['asset', 'threatGroup', 'threat', 'vulnerabilityGroup', 'vulnerability'])->paginate(10);

        // Fetch asset names based on asset IDs from risk assessments
        $assetNames = AssetRegister::whereIn('id', $riskAssessments->pluck('asset_id'))->get()->keyBy('id');

        // Pass both risk assessments and asset names to the view
        return view('user.risk_assessments.index', compact('riskAssessments', 'assetNames'));
    }

    public function create()
    {
        $assets = AssetRegister::all();
        $threatGroups = ThreatGroup::with('threats')->get();
        $vulnerabilityGroups = VulnerabilityGroup::with('vulnerabilities')->get();
        return view('user.risk_assessments.create', compact('assets', 'threatGroups', 'vulnerabilityGroups'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:asset_register,asset_id',
            'threat_group_id' => 'required|exists:threat_groups,id',
            'threat_id' => 'required|exists:threats,id',
            'vulnerability_group_id' => 'required|exists:vulnerability_groups,id',
            'vulnerability_id' => 'required|exists:vulnerabilities,id',
            'confidentiality' => 'required|integer',
            'integrity' => 'required|integer',
            'availability' => 'required|integer',
            'personnel' => 'required|string|max:255',
            'likelihood' => 'required|in:Low,Medium,High',
            'impact' => 'required|in:Low,Medium,High',
            'risk_level' => 'required|in:Low,Medium,High',
            'risk_owner' => 'required|string|max:255',
            'mitigation_option' => 'required|string',
            'treatment' => 'nullable|string',
        ]);

        dd($validated); // Check validated data

    RiskAssessment::create($validated);
    
    return redirect()->route('risk_assessments.index')->with('success', 'Risk Assessment created successfully.');
    }

    public function edit($id)
{
    $riskAssessment = RiskAssessment::with(['asset', 'threatGroup', 'threat', 'vulnerabilityGroup', 'vulnerability'])->findOrFail($id);
    $assets = AssetRegister::all();
    $threatGroups = ThreatGroup::with('threats')->get();
    $vulnerabilityGroups = VulnerabilityGroup::with('vulnerabilities')->get();
    
    return view('user.risk_assessments.edit', compact('riskAssessment', 'assets', 'threatGroups', 'vulnerabilityGroups'));
}


public function update(Request $request, $id)
{
    // Find the risk assessment by ID
    $riskAssessment = RiskAssessment::findOrFail($id);

    // Validate the request data
    $validated = $request->validate([
        'asset_id' => 'required|exists:asset_register,id',
        'threat_group_id' => 'required|exists:threat_groups,id',
        'threat_id' => 'required|exists:threats,id',
        'vulnerability_group_id' => 'required|exists:vulnerability_groups,id',
        'vulnerability_id' => 'required|exists:vulnerabilities,id',
        'confidentiality' => 'required|integer',
        'integrity' => 'required|integer',
        'availability' => 'required|integer',
        'personnel' => 'required|string|max:255',
        'likelihood' => 'required|in:Low,Medium,High',
        'impact' => 'required|in:Low,Medium,High',
        'risk_level' => 'required|in:Low,Medium,High',
        'risk_owner' => 'required|string|max:255',
        'mitigation_option' => 'required|string',
        'treatment' => 'nullable|string',
    ]);

    // Update the risk assessment with validated data
    $riskAssessment->update($validated);

    // Redirect back with a success message
    return redirect()->route('risk_assessments.index')->with('success', 'Risk Assessment updated successfully.');
}
    public function destroy($id)
    {
        $riskAssessment = RiskAssessment::findOrFail($id);
        $riskAssessment->delete();

        return redirect()->route('risk_assessments.index')->with('success', 'Risk Assessment deleted successfully.');
    }

}

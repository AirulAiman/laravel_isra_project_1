<?php

namespace App\Http\Controllers;

use App\Models\RiskAssessment;
use App\Models\AssetRegister;
use App\Models\ThreatGroup;
use App\Models\Threat;
use App\Models\VulnerabilityGroup;
use App\Models\Vulnerability;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class RiskAssessmentController extends Controller
{
    public function index(): View
    {
        $riskAssessments = RiskAssessment::all();
        return view('risk_assessments.index', compact('riskAssessments'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'asset_id' => 'required|exists:asset_register,id',
            'threat_group_id' => 'nullable|exists:threat_groups,id',
            'threat_id' => 'nullable|exists:threats,id',
            'vulnerability_group_id' => 'nullable|exists:vulnerability_groups,id',
            'vulnerability_id' => 'nullable|exists:vulnerabilities,id',
            'confidentiality' => 'required|integer|min:1|max:3',
            'integrity' => 'required|integer|min:1|max:3',
            'availability' => 'required|integer|min:1|max:3',
            'personnel' => 'nullable|string|max:255',
            'business_loss' => 'required|in:Low,Medium,High',
            'likelihood' => 'required|in:Low,Medium,High',
            'risk_owner' => 'nullable|string|max:255',
            'mitigation_option' => 'nullable|string',
            'treatment' => 'nullable|string',
            'actions' => 'nullable|string',
        ]);

        $riskAssessment = new RiskAssessment($request->all());
        $riskAssessment->calculateScores();
        $riskAssessment->save();

        return redirect()->route('risk_assessments.index')
            ->with('success', 'Risk Assessment created successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiskAssessment  $risk_assessment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $riskAssessment = RiskAssessment::findOrFail($id);
        $assets = AssetRegister::all();
        $threatGroups = ThreatGroup::all();
        $threats = Threat::all();
        $vulnerabilityGroups = VulnerabilityGroup::all();
        $vulnerabilities = Vulnerability::all();

        return view('risk_assessments.edit', compact(
            'riskAssessment', 'assets', 'threatGroups', 'threats', 'vulnerabilityGroups', 'vulnerabilities'
        ));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiskAssessment  $risk_assessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:asset_register,id',
            'threat_group_id' => 'nullable|exists:threat_groups,id',
            'threat_id' => 'nullable|exists:threats,id',
            'vulnerability_group_id' => 'nullable|exists:vulnerability_groups,id',
            'vulnerability_id' => 'nullable|exists:vulnerabilities,id',
            'confidentiality' => 'required|integer|min:1|max:3',
            'integrity' => 'required|integer|min:1|max:3',
            'availability' => 'required|integer|min:1|max:3',
            'personnel' => 'nullable|string|max:255',
            'business_loss' => 'required|in:Low,Medium,High',
            'likelihood' => 'required|in:Low,Medium,High',
            'risk_owner' => 'nullable|string|max:255',
            'mitigation_option' => 'nullable|string',
            'treatment' => 'nullable|string',
            'actions' => 'nullable|string',
        ]);

        $riskAssessment = RiskAssessment::findOrFail($id);
        $riskAssessment->fill($validated);
        $riskAssessment->calculateScores();
        $riskAssessment->save();

    
     
        // Calculate CIA Score
        $confidentiality = $request->input('confidentiality');
        $integrity = $request->input('integrity');
        $availability = $request->input('availability');
        
        $totalScore = $confidentiality + $integrity + $availability;

        // Determine the CIA score description
        if ($totalScore <= 3) {
            $ciaScore = 'Rendah';
        } elseif ($totalScore <= 6) {
            $ciaScore = 'Sederhana';
        } else {
            $ciaScore = 'Tinggi';
        }

        // Update the risk assessment
        $riskAssessment->confidentiality = $confidentiality;
        $riskAssessment->integrity = $integrity;
        $riskAssessment->availability = $availability;
        $riskAssessment->cia_score = $ciaScore; // Save the calculated CIA score
        $riskAssessment->save();

        return redirect()->route('risk_assessments.index')
        ->with('success', 'Risk Assessment updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiskAssessment  $risk_assessment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        $riskAssessment = RiskAssessment::findOrFail($id);
        $riskAssessment->delete();
    
        return redirect()->route('risk_assessments.index')
            ->with('success', 'Risk assessment deleted successfully.');
    }
}
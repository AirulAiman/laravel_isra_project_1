@extends('base.layout')

@section('content')
@include('navbar.layout')
<div class="container">
    <div class="modal-header">
        <h1 class="modal-title fs-5">Edit Risk Assessment</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('risk_assessments.update', $riskAssessment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Asset Selection -->
        <div class="form-group mb-3">
            <label for="asset_id">Asset</label>
            <select name="asset_id" id="asset_id" class="form-control" required>
                @foreach ($assets as $asset)
                    <option value="{{ $asset->id }}" {{ $riskAssessment->asset_id == $asset->id ? 'selected' : '' }}>
                        {{ $asset->asset_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Threat Group Selection -->
        <div class="form-group mb-3">
            <label for="threat_group_id">Threat Group</label>
            <select name="threat_group_id" id="threat_group_id" class="form-control">
                <option value="">Select Threat Group</option>
                @foreach($threatGroups as $threatGroup)
                    <option value="{{ $threatGroup->id }}" {{ $riskAssessment->threat_group_id == $threatGroup->id ? 'selected' : '' }}>
                        {{ $threatGroup->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Threat Selection -->
        <div class="form-group mb-3">
            <label for="threat_id">Threat</label>
            <select name="threat_id" id="threat_id" class="form-control">
                <option value="">Select Threat</option>
                @foreach($threats as $threat)
                    <option value="{{ $threat->id }}" {{ $riskAssessment->threat_id == $threat->id ? 'selected' : '' }}>
                        {{ $threat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Vulnerability Group Selection -->
        <div class="form-group mb-3">
            <label for="vulnerability_group_id">Vulnerability Group</label>
            <select name="vulnerability_group_id" id="vulnerability_group_id" class="form-control">
                <option value="">Select Vulnerability Group</option>
                @foreach($vulnerabilityGroups as $vulnerabilityGroup)
                    <option value="{{ $vulnerabilityGroup->id }}" {{ $riskAssessment->vulnerability_group_id == $vulnerabilityGroup->id ? 'selected' : '' }}>
                        {{ $vulnerabilityGroup->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Vulnerability Selection -->
        <div class="form-group mb-3">
            <label for="vulnerability_id">Vulnerability</label>
            <select name="vulnerability_id" id="vulnerability_id" class="form-control">
                <option value="">Select Vulnerability</option>
                @foreach($vulnerabilities as $vulnerability)
                    <option value="{{ $vulnerability->id }}" {{ $riskAssessment->vulnerability_id == $vulnerability->id ? 'selected' : '' }}>
                        {{ $vulnerability->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- CIA Scores -->
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="confidentiality">Confidentiality (1-3)</label>
                    <input type="number" name="confidentiality" id="confidentiality" class="form-control" 
                           value="{{ $riskAssessment->confidentiality }}" required min="1" max="3">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="integrity">Integrity (1-3)</label>
                    <input type="number" name="integrity" id="integrity" class="form-control" 
                           value="{{ $riskAssessment->integrity }}" required min="1" max="3">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="availability">Availability (1-3)</label>
                    <input type="number" name="availability" id="availability" class="form-control" 
                           value="{{ $riskAssessment->availability }}" required min="1" max="3">
                </div>
            </div>
        </div>

        <!-- Likelihood -->
        <div class="form-group mb-3">
            <label for="likelihood">Likelihood</label>
            <select name="likelihood" id="likelihood" class="form-control" required>
                <option value="Low" {{ $riskAssessment->likelihood == 'Low' ? 'selected' : '' }}>Low (Score: 1)</option>
                <option value="Medium" {{ $riskAssessment->likelihood == 'Medium' ? 'selected' : '' }}>Medium (Score: 2)</option>
                <option value="High" {{ $riskAssessment->likelihood == 'High' ? 'selected' : '' }}>High (Score: 3)</option>
            </select>
        </div>

        <!-- Probability -->
        <div class="form-group mb-3">
            <label for="probability">Probability of Becoming a Threat</label>
            <select name="probability" id="probability" class="form-control" required>
                <option value="No probability" {{ $riskAssessment->probability == 'No probability' ? 'selected' : '' }}>No probability (Score: 1)</option>
                <option value="Once in a while" {{ $riskAssessment->probability == 'Once in a while' ? 'selected' : '' }}>Once in a while (Score: 2)</option>
                <option value="Most likely" {{ $riskAssessment->probability == 'Most likely' ? 'selected' : '' }}>Most likely (Score: 3)</option>
            </select>
        </div>

        <!-- Personnel -->
        <div class="form-group mb-3">
            <label for="personnel">Personnel</label>
            <input type="text" name="personnel" id="personnel" class="form-control" 
                   value="{{ $riskAssessment->personnel }}">
        </div>

        <!-- Risk Owner -->
        <div class="form-group mb-3">
            <label for="risk_owner">Risk Owner</label>
            <input type="text" name="risk_owner" id="risk_owner" class="form-control" 
                   value="{{ $riskAssessment->risk_owner }}">
        </div>

        <!-- Mitigation Option -->
        <div class="form-group mb-3">
            <label for="mitigation_option">Mitigation Option</label>
            <textarea name="mitigation_option" id="mitigation_option" class="form-control" rows="3">{{ $riskAssessment->mitigation_option }}</textarea>
        </div>

        <!-- Treatment -->
        <div class="form-group mb-3">
            <label for="treatment">Treatment</label>
            <textarea name="treatment" id="treatment" class="form-control" rows="3">{{ $riskAssessment->treatment }}</textarea>
        </div>

        <!-- Actions -->
        <div class="form-group mb-3">
            <label for="actions">Actions</label>
            <textarea name="actions" id="actions" class="form-control" rows="3">{{ $riskAssessment->actions }}</textarea>
        </div>

        <!-- Read-only Score Display -->
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Current CIA Impact Score</label>
                    <input type="text" class="form-control" value="{{ number_format($riskAssessment->cia_impact_score, 2) }}" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Current Impact Level</label>
                    <input type="text" class="form-control" value="{{ $riskAssessment->impact_level }}" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Current Final Risk Level</label>
                    <input type="text" class="form-control" value="{{ $riskAssessment->final_risk_level }}" readonly>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Risk Assessment</button>
            <a href="{{ route('risk_assessments.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to update the read-only score displays
    function updateScoreDisplays() {
        const confidentiality = parseInt(document.getElementById('confidentiality').value) || 0;
        const integrity = parseInt(document.getElementById('integrity').value) || 0;
        const availability = parseInt(document.getElementById('availability').value) || 0;
        const likelihood = document.getElementById('likelihood').value;
        const probability = document.getElementById('probability').value;

        // Calculate likelihood score
        const likelihoodScore = likelihood === 'High' ? 3 : (likelihood === 'Medium' ? 2 : 1);

        // Calculate CIA impact score
        const ciaAverage = (confidentiality + integrity + availability) / 3;
        const ciaImpactScore = ciaAverage * likelihoodScore;

        // Determine impact level
        let impactLevel;
        if (ciaImpactScore >= 2.5) impactLevel = 'High';
        else if (ciaImpactScore >= 1.5) impactLevel = 'Medium';
        else impactLevel = 'Low';

        // Calculate probability score
        const probabilityScore = probability === 'Most likely' ? 3 : (probability === 'Once in a while' ? 2 : 1);

        // Calculate final risk score
        const finalRiskScore = probabilityScore * ciaImpactScore;

        // Determine final risk level
        let finalRiskLevel;
        if (finalRiskScore >= 5) finalRiskLevel = 'High';
        else if (finalRiskScore >= 3) finalRiskLevel = 'Medium';
        else finalRiskLevel = 'Low';

        // Update the display fields
        document.querySelector('input[value="{{ number_format($riskAssessment->cia_impact_score, 2) }}"]').value = ciaImpactScore.toFixed(2);
        document.querySelector('input[value="{{ $riskAssessment->impact_level }}"]').value = impactLevel;
        document.querySelector('input[value="{{ $riskAssessment->final_risk_level }}"]').value = finalRiskLevel;
    }

    // Add event listeners to all inputs that affect the scores
    const inputs = ['confidentiality', 'integrity', 'availability', 'likelihood', 'probability'];
    inputs.forEach(id => {
        document.getElementById(id).addEventListener('change', updateScoreDisplays);
    });
});
</script>
@endsection
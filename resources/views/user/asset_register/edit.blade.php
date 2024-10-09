@extends('base.layout')

@section('title', 'Edit Asset')

@section('content')
@include('navbar.layout')

<div class="container">
    <h1>Edit Risk Assessment</h1>
    
    <form action="{{ route('risk_assessments.update', $riskAssessment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="asset_id">Asset</label>
            <select name="asset_id" id="asset_id" class="form-control">
                @foreach ($assets as $asset)
                    <option value="{{ $asset->id }}" {{ $riskAssessment->asset_id == $asset->id ? 'selected' : '' }}>
                        {{ $asset->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="threat_group_id">Threat Group</label>
            <select name="threat_group_id" id="threat_group_id" class="form-control">
                @foreach ($threatGroups as $threatGroup)
                    <option value="{{ $threatGroup->id }}" {{ $riskAssessment->threat_group_id == $threatGroup->id ? 'selected' : '' }}>
                        {{ $threatGroup->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="threat_id">Threat</label>
            <select name="threat_id" id="threat_id" class="form-control">
                <!-- Options will be populated dynamically -->
            </select>
        </div>

        <div class="form-group">
            <label for="vulnerability_group_id">Vulnerability Group</label>
            <select name="vulnerability_group_id" id="vulnerability_group_id" class="form-control">
                @foreach ($vulnerabilityGroups as $vulnerabilityGroup)
                    <option value="{{ $vulnerabilityGroup->id }}" {{ $riskAssessment->vulnerability_group_id == $vulnerabilityGroup->id ? 'selected' : '' }}>
                        {{ $vulnerabilityGroup->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="vulnerability_id">Vulnerability</label>
            <select name="vulnerability_id" id="vulnerability_id" class="form-control">
                <!-- Options will be populated dynamically -->
            </select>
        </div>

        <div class="form-group">
            <label for="confidentiality">Confidentiality</label>
            <input type="number" name="confidentiality" id="confidentiality" class="form-control" value="{{ $riskAssessment->confidentiality }}">
        </div>

        <div class="form-group">
            <label for="integrity">Integrity</label>
            <input type="number" name="integrity" id="integrity" class="form-control" value="{{ $riskAssessment->integrity }}">
        </div>

        <div class="form-group">
            <label for="availability">Availability</label>
            <input type="number" name="availability" id="availability" class="form-control" value="{{ $riskAssessment->availability }}">
        </div>

        <div class="form-group">
            <label for="personnel">Personnel</label>
            <input type="text" name="personnel" id="personnel" class="form-control" value="{{ $riskAssessment->personnel }}">
        </div>

        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ \Carbon\Carbon::parse($riskAssessment->start_time)->format('Y-m-d\TH:i') }}">
        </div>

        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ $riskAssessment->end_time ? \Carbon\Carbon::parse($riskAssessment->end_time)->format('Y-m-d\TH:i') : '' }}">
        </div>

        <div class="form-group">
            <label for="likelihood">Likelihood</label>
            <select name="likelihood" id="likelihood" class="form-control">
                <option value="Low" {{ $riskAssessment->likelihood == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ $riskAssessment->likelihood == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ $riskAssessment->likelihood == 'High' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="impact">Impact</label>
            <select name="impact" id="impact" class="form-control">
                <option value="Low" {{ $riskAssessment->impact == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ $riskAssessment->impact == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ $riskAssessment->impact == 'High' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="risk_level">Risk Level</label>
            <select name="risk_level" id="risk_level" class="form-control">
                <option value="Low" {{ $riskAssessment->risk_level == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ $riskAssessment->risk_level == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ $riskAssessment->risk_level == 'High' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="risk_owner">Risk Owner</label>
            <input type="text" name="risk_owner" id="risk_owner" class="form-control" value="{{ $riskAssessment->risk_owner }}">
        </div>

        <div class="form-group">
            <label for="mitigation_option">Mitigation Option</label>
            <textarea name="mitigation_option" id="mitigation_option" class="form-control">{{ $riskAssessment->mitigation_option }}</textarea>
        </div>

        <div class="form-group">
            <label for="treatment">Treatment</label>
            <textarea name="treatment" id="treatment" class="form-control">{{ $riskAssessment->treatment }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Risk Assessment</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const threatGroupSelect = document.getElementById('threat_group_id');
        const threatSelect = document.getElementById('threat_id');
        const vulnerabilityGroupSelect = document.getElementById('vulnerability_group_id');
        const vulnerabilitySelect = document.getElementById('vulnerability_id');

        function fetchThreats(groupId) {
            fetch(`/get-threats/${groupId}`)
                .then(response => response.json())
                .then(data => {
                    threatSelect.innerHTML = '<option value="">Select Threat</option>';
                    data.forEach(threat => {
                        threatSelect.innerHTML += `<option value="${threat.id}">${threat.name}</option>`;
                    });
                    threatSelect.value = "{{ $riskAssessment->threat_id }}"; // Set selected value
                });
        }

        function fetchVulnerabilities(groupId) {
            fetch(`/get-vulnerabilities/${groupId}`)
                .then(response => response.json())
                .then(data => {
                    vulnerabilitySelect.innerHTML = '<option value="">Select Vulnerability</option>';
                    data.forEach(vulnerability => {
                        vulnerabilitySelect.innerHTML += `<option value="${vulnerability.id}">${vulnerability.name}</option>`;
                    });
                    vulnerabilitySelect.value = "{{ $riskAssessment->vulnerability_id }}"; // Set selected value
                });
        }

        threatGroupSelect.addEventListener('change', function() {
            fetchThreats(this.value);
        });

        vulnerabilityGroupSelect.addEventListener('change', function() {
            fetchVulnerabilities(this.value);
        });

        // Initially fetch threats and vulnerabilities based on selected values
        fetchThreats("{{ $riskAssessment->threat_group_id }}");
        fetchVulnerabilities("{{ $riskAssessment->vulnerability_group_id }}");
    });
</script>
@endsection

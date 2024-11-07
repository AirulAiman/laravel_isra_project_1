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

    <form action="{{ route('risk_assessment.update', $riskAssessment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Asset Selection -->
        <div class="form-group">
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
        <div class="form-group">
            <label for="threat_group_id">Threat Group</label>
            <select name="threat_group_id" id="threat_group_id">
                @foreach($threatGroups as $threatGroup)
                    <option value="{{ $threatGroup->id }}" {{ $riskAssessment->threat_group_id == $threatGroup->id ? 'selected' : '' }}>{{ $threatGroup->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Threat Selection -->
        <div class="form-group">
            <label for="threat_id">Threat</label>
            <select name="threat_id" id="threat_id">
                @foreach($threats as $threat)
                    <option value="{{ $threat->id }}" {{ $riskAssessment->threat_id == $threat->id ? 'selected' : '' }}>{{ $threat->name }}</option>
                @endforeach
            </select>
        </div>
        

        <!-- Vulnerability Group Selection -->
        <div class="form-group">
            <label for="vulnerability_group_id">Vulnerability Group</label>
            <select name="vulnerability_group_id" id="vulnerability_group_id">
                @foreach($vulnerabilityGroups as $vulnerabilityGroup)
                    <option value="{{ $vulnerabilityGroup->id }}" {{ $riskAssessment->vulnerability_group_id == $vulnerabilityGroup->id ? 'selected' : '' }}>{{ $vulnerabilityGroup->name }}</option>
                @endforeach
            </select>
        </div>
        
        <!-- Vulnerability Selection -->
        <div class="form-group">
            <label for="vulnerability_id">Vulnerability</label>
            <select name="vulnerability_id" id="vulnerability_id">
                @foreach($vulnerabilities as $vulnerability)
                    <option value="{{ $vulnerability->id }}" {{ $riskAssessment->vulnerability_id == $vulnerability->id ? 'selected' : '' }}>{{ $vulnerability->name }}</option>
                @endforeach
            </select>
        </div>
        

        <!-- Confidentiality, Integrity, and Availability -->
<div class="form-group">
    <label for="confidentiality">Confidentiality</label>
    <div>
        @for ($i = 1; $i <= 5; $i++)
            <input type="radio" name="confidentiality" id="confidentiality-{{ $i }}" value="{{ $i }}" {{ $riskAssessment->confidentiality == $i ? 'checked' : '' }}>
            <label for="confidentiality-{{ $i }}">{{ $i }}</label>
        @endfor
    </div>
</div>

<div class="form-group">
    <label for="integrity">Integrity</label>
    <div>
        @for ($i = 1; $i <= 5; $i++)
            <input type="radio" name="integrity" id="integrity-{{ $i }}" value="{{ $i }}" {{ $riskAssessment->integrity == $i ? 'checked' : '' }}>
            <label for="integrity-{{ $i }}">{{ $i }}</label>
        @endfor
    </div>
</div>

<div class="form-group">
    <label for="availability">Availability</label>
    <div>
        @for ($i = 1; $i <= 5; $i++)
            <input type="radio" name="availability" id="availability-{{ $i }}" value="{{ $i }}" {{ $riskAssessment->availability == $i ? 'checked' : '' }}>
            <label for="availability-{{ $i }}">{{ $i }}</label>
        @endfor
    </div>
</div>

<input type="hidden" name="cia_score" id="cia_score" value="{{ $riskAssessment->cia_score }}">

        <!-- Personnel -->
        <div class="form-group">
            <label for="personnel">Personnel</label>
            <input type="text" name="personnel" id="personnel" class="form-control" value="{{ $riskAssessment->personnel }}">
        </div>
        <!-- Likelihood, Impact, and Risk Level -->
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

        <!-- Risk Owner, Mitigation Option, Treatment, Actions -->
        <div class="form-group">
            <label for="risk_owner">Risk Owner</label>
            <input type="text" name="risk_owner" id="risk_owner" class="form-control" value="{{ $riskAssessment->risk_owner }}">
        </div>
        <div class="form-group">
            <label for="mitigation_option">Mitigation Option</label>
            <input type="text" name="mitigation_option" id="mitigation_option" class="form-control" value="{{ $riskAssessment->mitigation_option }}">
        </div>
        <div class="form-group">
            <label for="treatment">Treatment</label>
            <textarea name="treatment" id="treatment" class="form-control">{{ $riskAssessment->treatment }}</textarea>
        </div>
        <div class="form-group">
            <label for="actions">Actions</label>
            <textarea name="actions" id="actions" class="form-control">{{ $riskAssessment->actions }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

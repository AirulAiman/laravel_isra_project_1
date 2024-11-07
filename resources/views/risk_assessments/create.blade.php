@extends('base.layout')

@section('content')
<div class="container">
    <h1>Create Risk Assessment</h1>

    <form action="{{ route('risk_assessment.store') }}" method="POST">
        @csrf
        
        <!-- Asset Select -->
        <div class="form-group">
            <label for="asset_id">Asset</label>
            <select name="asset_id" class="form-control">
                @foreach($assets as $asset)
                    <option value="{{ $asset->id }}">{{ $asset->asset_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Threat Group Select -->
        <div class="form-group">
            <label for="threat_group_id">Threat Group</label>
            <select name="threat_group_id" class="form-control">
                @foreach($threatGroups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Threat Select -->
        <div class="form-group">
            <label for="threat_id">Threat</label>
            <select name="threat_id" class="form-control">
                @foreach($threats as $threat)
                    <option value="{{ $threat->id }}">{{ $threat->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Vulnerability Group Select -->
        <div class="form-group">
            <label for="vulnerability_group_id">Vulnerability Group</label>
            <select name="vulnerability_group_id" class="form-control">
                @foreach($vulnerabilityGroups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Vulnerability Select -->
        <div class="form-group">
            <label for="vulnerability_id">Vulnerability</label>
            <select name="vulnerability_id" class="form-control">
                @foreach($vulnerabilities as $vulnerability)
                    <option value="{{ $vulnerability->id }}">{{ $vulnerability->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Confidentiality, Integrity, Availability -->
        <div class="form-group">
            <label for="confidentiality">Confidentiality</label>
            <input type="number" name="confidentiality" class="form-control">
        </div>

        <div class="form-group">
            <label for="integrity">Integrity</label>
            <input type="number" name="integrity" class="form-control">
        </div>

        <div class="form-group">
            <label for="availability">Availability</label>
            <input type="number" name="availability" class="form-control">
        </div>

        <!-- Personnel -->
        <div class="form-group">
            <label for="personnel">Personnel</label>
            <input type="text" name="personnel" class="form-control">
        </div>

        <!-- Likelihood, Impact, Risk Level -->
        <div class="form-group">
            <label for="likelihood">Likelihood</label>
            <input type="text" name="likelihood" class="form-control">
        </div>

        <div class="form-group">
            <label for="impact">Impact</label>
            <input type="text" name="impact" class="form-control">
        </div>

        <div class="form-group">
            <label for="risk_level">Risk Level</label>
            <select name="risk_level" class="form-control">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>

        <!-- Risk Owner -->
        <div class="form-group">
            <label for="risk_owner">Risk Owner</label>
            <input type="text" name="risk_owner" class="form-control">
        </div>

        <!-- Mitigation Option, Treatment -->
        <div class="form-group">
            <label for="mitigation_option">Mitigation Option</label>
            <input type="text" name="mitigation_option" class="form-control">
        </div>

        <div class="form-group">
            <label for="treatment">Treatment</label>
            <input type="text" name="treatment" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection

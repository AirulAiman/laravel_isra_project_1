@extends('base.layout')

@section('content')

@include('navbar.layout')

<div class="container">
    <h1>Create New Risk Assessment</h1>

    <form action="{{ route('risk_assessments.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="asset_id">Asset</label>
            <select name="asset_id" id="asset_id" class="form-control" required>
                @foreach($assets as $asset)
                    <option value="{{ $asset->asset_id }}">{{ $asset->asset_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="threat_group_id">Threat Group</label>
            <select name="threat_group_id" id="threat_group_id" class="form-control" required>
                @foreach($threatGroups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="threat_id">Threat</label>
            <select name="threat_id" id="threat_id" class="form-control" required>
                <option value="">Select Threat</option>
                <!-- JavaScript will populate this based on the selected group -->
            </select>
        </div>

        <div class="form-group">
            <label for="vulnerability_group_id">Vulnerability Group</label>
            <select name="vulnerability_group_id" id="vulnerability_group_id" class="form-control" required>
                @foreach($vulnerabilityGroups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="vulnerability_id">Vulnerability</label>
            <select name="vulnerability_id" id="vulnerability_id" class="form-control" required>
                <option value="">Select Vulnerability</option>
                <!-- JavaScript will populate this based on the selected group -->
            </select>
        </div>
        <div class="form-group">
            <label for="confidentiality">Confidentiality</label>
            <input type="number" name="confidentiality" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="integrity">Integrity</label>
            <input type="number" name="integrity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="availability">Availability</label>
            <input type="number" name="availability" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="personnel">Personnel</label>
            <input type="text" name="personnel" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="datetime-local" name="start_time" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="datetime-local" name="end_time" class="form-control">
        </div>

        <div class="form-group">
            <label for="likelihood">Likelihood</label>
            <select name="likelihood" class="form-control" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="impact">Impact</label>
            <select name="impact" class="form-control" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="risk_level">Risk Level</label>
            <select name="risk_level" class="form-control" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="risk_owner">Risk Owner</label>
            <input type="text" name="risk_owner" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="mitigation_option">Mitigation Option</label>
            <textarea name="mitigation_option" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="treatment">Treatment</label>
            <textarea name="treatment" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Risk Assessment</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// JavaScript to populate threats and vulnerabilities based on selected groups
document.getElementById('threat_group_id').addEventListener('change', function() {
    const groupId = this.value;
    $('#threat_id').load(`/threats/group/${groupId}`);
});

document.getElementById('vulnerability_group_id').addEventListener('change', function() {
    const groupId = this.value;
    $('#vulnerability_id').load(`/vulnerabilities/group/${groupId}`);
});
</script>

@endsection

@extends('base.layout')

@section('title', 'Create Risk Assessment')

@section('content')
@include('navbar.layout')
<div class="container">
    <h1>Edit Risk Assessment</h1>

    <form action="{{ route('risk_assessments.update', $riskAssessment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="asset_id">Asset</label>
            <select name="asset_id" id="asset_id" class="form-control" required>
                @foreach($assets as $asset)
                    <option value="{{ $asset->id }}" {{ $asset->id == $riskAssessment->asset_id ? 'selected' : '' }}>
                        {{ $asset->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="threat_group_id">Threat Group</label>
            <select name="threat_group_id" id="threat_group_id" class="form-control" required>
                @foreach($threatGroups as $group)
                    <option value="{{ $group->id }}" {{ $group->id == $riskAssessment->threat_group_id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="threat_id">Threat</label>
            <select name="threat_id" id="threat_id" class="form-control" required>
                @if($riskAssessment->threatGroup)
                    @foreach($riskAssessment->threatGroup->threats as $threat)
                        <option value="{{ $threat->id }}" {{ $threat->id == $riskAssessment->threat_id ? 'selected' : '' }}>
                            {{ $threat->name }}
                        </option>
                    @endforeach
                @else
                    <option value="">No threats available</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="vulnerability_group_id">Vulnerability Group</label>
            <select name="vulnerability_group_id" id="vulnerability_group_id" class="form-control" required>
                @foreach($vulnerabilityGroups as $group)
                    <option value="{{ $group->id }}" {{ $group->id == $riskAssessment->vulnerability_group_id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="vulnerability_id">Vulnerability</label>
            <select name="vulnerability_id" id="vulnerability_id" class="form-control" required>
                @if($riskAssessment->vulnerabilityGroup)
                    @foreach($riskAssessment->vulnerabilityGroup->vulnerabilities as $vulnerability)
                        <option value="{{ $vulnerability->id }}" {{ $vulnerability->id == $riskAssessment->vulnerability_id ? 'selected' : '' }}>
                            {{ $vulnerability->name }}
                        </option>
                    @endforeach
                @else
                    <option value="">No vulnerabilities available</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="confidentiality">Confidentiality</label>
            <input type="number" class="form-control" name="confidentiality" value="{{ old('confidentiality', $riskAssessment->confidentiality) }}" required>
        </div>

        <div class="form-group">
            <label for="integrity">Integrity</label>
            <input type="number" class="form-control" name="integrity" value="{{ old('integrity', $riskAssessment->integrity) }}" required>
        </div>

        <div class="form-group">
            <label for="availability">Availability</label>
            <input type="number" class="form-control" name="availability" value="{{ old('availability', $riskAssessment->availability) }}" required>
        </div>

        <div class="form-group">
            <label for="personnel">Personnel</label>
            <input type="text" class="form-control" name="personnel" value="{{ old('personnel', $riskAssessment->personnel) }}" required>
        </div>

        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="date" class="form-control" name="start_time" value="{{ old('start_time', $riskAssessment->start_time) }}" required>
        </div>

        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="date" class="form-control" name="end_time" value="{{ old('end_time', $riskAssessment->end_time) }}">
        </div>

        <div class="form-group">
            <label for="likelihood">Likelihood</label>
            <select name="likelihood" class="form-control" required>
                <option value="Low" {{ $riskAssessment->likelihood == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ $riskAssessment->likelihood == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ $riskAssessment->likelihood == 'High' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="impact">Impact</label>
            <select name="impact" class="form-control" required>
                <option value="Low" {{ $riskAssessment->impact == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ $riskAssessment->impact == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ $riskAssessment->impact == 'High' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="risk_level">Risk Level</label>
            <select name="risk_level" class="form-control" required>
                <option value="Low" {{ $riskAssessment->risk_level == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ $riskAssessment->risk_level == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ $riskAssessment->risk_level == 'High' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="risk_owner">Risk Owner</label>
            <input type="text" class="form-control" name="risk_owner" value="{{ old('risk_owner', $riskAssessment->risk_owner) }}" required>
        </div>

        <div class="form-group">
            <label for="mitigation_option">Mitigation Option</label>
            <textarea class="form-control" name="mitigation_option" required>{{ old('mitigation_option', $riskAssessment->mitigation_option) }}</textarea>
        </div>

        <div class="form-group">
            <label for="treatment">Treatment</label>
            <textarea class="form-control" name="treatment">{{ old('treatment', $riskAssessment->treatment) }}</textarea>
        </div>

       
        <button type="submit" class="btn btn-primary">Update Risk Assessment</button>
    </form>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        // Change event for threat group
        $('#threat_group_id').change(function() {
            var groupId = $(this).val();
            $.ajax({
                url: '/get-threats/' + groupId,
                method: 'GET',
                success: function(data) {
                    $('#threat_id').empty();
                    $.each(data, function(index, threat) {
                        $('#threat_id').append('<option value="' + threat.id + '">' + threat.name + '</option>');
                    });
                },
                error: function() {
                    alert('Could not load threats. Please try again.');
                }
            });
        });

        // Change event for vulnerability group
        $('#vulnerability_group_id').change(function() {
            var groupId = $(this).val();
            $.ajax({
                url: '/get-vulnerabilities/' + groupId,
                method: 'GET',
                success: function(data) {
                    $('#vulnerability_id').empty();
                    $.each(data, function(index, vulnerability) {
                        $('#vulnerability_id').append('<option value="' + vulnerability.id + '">' + vulnerability.name + '</option>');
                    });
                },
                error: function() {
                    alert('Could not load vulnerabilities. Please try again.');
                }
            });
        });
    });
</script>
@endsection
@endsection

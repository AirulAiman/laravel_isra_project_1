@extends('base.layout')

@section('content')

@include('navbar.layout')


<div class="container">
    <h1>Edit Risk Assessment</h1>

    <form action="{{ route('risk_assessments.update', $riskAssessment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Asset Selection -->
        <div class="form-group">
            <label for="asset_id">Asset:</label>
            <select name="asset_id" id="asset_id" class="form-control">
                @foreach($assets as $asset)
                    <option value="{{ $asset->asset_id }}" {{ $riskAssessment->asset_id == $asset->asset_id ? 'selected' : '' }}>
                        {{ $asset->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Threat Group Selection -->
        <div class="form-group">
            <label for="threat_group_id">Threat Group:</label>
            <select name="threat_group_id" id="threat_group_id" class="form-control">
                <option value="">Select Threat Group</option>
                @foreach($threatGroups as $group)
                    <option value="{{ $group->id }}" {{ $riskAssessment->threat_group_id == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Threat Selection (dynamic) -->
        <div class="form-group">
            <label for="threat_id">Threat:</label>
            <select name="threat_id" id="threat_id" class="form-control">
                @if($riskAssessment->threats)
                    @foreach($riskAssessment->threatGroup->threats as $threat)
                        <option value="{{ $threat->id }}" {{ $riskAssessment->threat_id == $threat->id ? 'selected' : '' }}>
                            {{ $threat->name }}
                        </option>
                    @endforeach
                @else
                    <option value="">Select Threat</option>
                @endif
            </select>
        </div>

        <!-- Vulnerability Group Selection -->
        <div class="form-group">
            <label for="vulnerability_group_id">Vulnerability Group:</label>
            <select name="vulnerability_group_id" id="vulnerability_group_id" class="form-control">
                <option value="">Select Vulnerability Group</option>
                @foreach($vulnerabilityGroups as $group)
                    <option value="{{ $group->id }}" {{ $riskAssessment->vulnerability_group_id == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Vulnerability Selection (dynamic) -->
        <div class="form-group">
            <label for="vulnerability_id">Vulnerability:</label>
            <select name="vulnerability_id" id="vulnerability_id" class="form-control">
                @if($riskAssessment->vulnerabilities)
                    @foreach($riskAssessment->vulnerabilityGroup->vulnerabilities as $vulnerability)
                        <option value="{{ $vulnerability->id }}" {{ $riskAssessment->vulnerability_id == $vulnerability->id ? 'selected' : '' }}>
                            {{ $vulnerability->name }}
                        </option>
                    @endforeach
                @else
                    <option value="">Select Vulnerability</option>
                @endif
            </select>
        </div>

        <!-- Likelihood, Impact, and Risk Level -->
        <div class="form-group">
            <label for="likelihood">Likelihood:</label>
            <select name="likelihood" class="form-control">
                <option value="Low" {{ $riskAssessment->likelihood == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ $riskAssessment->likelihood == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ $riskAssessment->likelihood == 'High' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="impact">Impact:</label>
            <select name="impact" class="form-control">
                <option value="Low" {{ $riskAssessment->impact == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ $riskAssessment->impact == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ $riskAssessment->impact == 'High' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="risk_level">Risk Level:</label>
            <select name="risk_level" class="form-control">
                <option value="Low" {{ $riskAssessment->risk_level == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ $riskAssessment->risk_level == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ $riskAssessment->risk_level == 'High' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <!-- Personnel, Risk Owner, and Mitigation -->
        <div class="form-group">
            <label for="personnel">Personnel:</label>
            <input type="text" name="personnel" class="form-control" value="{{ $riskAssessment->personnel }}">
        </div>

        <div class="form-group">
            <label for="risk_owner">Risk Owner:</label>
            <input type="text" name="risk_owner" class="form-control" value="{{ $riskAssessment->risk_owner }}">
        </div>

        <div class="form-group">
            <label for="mitigation_option">Mitigation Option:</label>
            <textarea name="mitigation_option" class="form-control">{{ $riskAssessment->mitigation_option }}</textarea>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Update Risk Assessment</button>
    </form>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // When a threat group is selected, load the threats
        $('#threat_group_id').change(function() {
            var groupId = $(this).val();
            if (groupId) {
                $.ajax({
                    url: '{{ url("get-threats-by-group") }}/' + groupId,
                    type: 'GET',
                    success: function(data) {
                        $('#threat_id').html(data);
                    }
                });
            } else {
                $('#threat_id').html('<option value="">Select Threat</option>');
            }
        });

        // When a vulnerability group is selected, load the vulnerabilities
        $('#vulnerability_group_id').change(function() {
            var groupId = $(this).val();
            if (groupId) {
                $.ajax({
                    url: '{{ url("get-vulnerabilities-by-group") }}/' + groupId,
                    type: 'GET',
                    success: function(data) {
                        $('#vulnerability_id').html(data);
                    }
                });
            } else {
                $('#vulnerability_id').html('<option value="">Select Vulnerability</option>');
            }
        });
    });
</script>
@endsection
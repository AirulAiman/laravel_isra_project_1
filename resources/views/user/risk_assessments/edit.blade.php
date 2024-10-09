@extends('base.layout')

@section('content')

@include('navbar.layout')

<div class="container">
    <div class="container">
        <h1>Edit Risk Assessment</h1>
    
        <form action="{{ route('risk_assessments.update', $riskAssessment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="threat_group_id">Threat Group</label>
                <select name="threat_group_id" id="threat_group_id" class="form-control">
                    @foreach ($threatGroups as $group)
                        <option value="{{ $group->id }}" {{ $group->id == $riskAssessment->threat_group_id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="threat_id">Threat</label>
                <select name="threat_id" id="threat_id" class="form-control">
                    @foreach ($threatGroups as $group)
                        @foreach ($group->threats as $threat)
                            <option value="{{ $threat->id }}" {{ $threat->id == $riskAssessment->threat_id ? 'selected' : '' }} class="threat-group-{{ $group->id }}">
                                {{ $threat->name }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="vulnerability_group_id">Vulnerability Group</label>
                <select name="vulnerability_group_id" id="vulnerability_group_id" class="form-control">
                    @foreach ($vulnerabilityGroups as $group)
                        <option value="{{ $group->id }}" {{ $group->id == $riskAssessment->vulnerability_group_id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="vulnerability_id">Vulnerability</label>
                <select name="vulnerability_id" id="vulnerability_id" class="form-control">
                    @foreach ($vulnerabilityGroups as $group)
                        @foreach ($group->vulnerabilities as $vulnerability)
                            <option value="{{ $vulnerability->id }}" {{ $vulnerability->id == $riskAssessment->vulnerability_id ? 'selected' : '' }} class="vulnerability-group-{{ $group->id }}">
                                {{ $vulnerability->name }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
            </div>

        {{-- @include('partials.vulnerabilities') <!-- Include vulnerabilities partial --> --}}

        <div class="form-group">
            <label for="confidentiality">Confidentiality</label>
            <input type="number" class="form-control" name="confidentiality" id="confidentiality" value="{{ $riskAssessment->confidentiality }}" required>
        </div>

        <div class="form-group">
            <label for="integrity">Integrity</label>
            <input type="number" class="form-control" name="integrity" id="integrity" value="{{ $riskAssessment->integrity }}" required>
        </div>

        <div class="form-group">
            <label for="availability">Availability</label>
            <input type="number" class="form-control" name="availability" id="availability" value="{{ $riskAssessment->availability }}" required>
        </div>

        <div class="form-group">
            <label for="personnel">Personnel</label>
            <input type="text" class="form-control" name="personnel" id="personnel" value="{{ $riskAssessment->personnel }}">
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
                <option value="Acceptable" {{ $riskAssessment->risk_level == 'Acceptable' ? 'selected' : '' }}>Acceptable</option>
                <option value="Unacceptable" {{ $riskAssessment->risk_level == 'Unacceptable' ? 'selected' : '' }}>Unacceptable</option>
            </select>
        </div>

        <div class="form-group">
            <label for="risk_owner">Risk Owner</label>
            <input type="text" class="form-control" name="risk_owner" id="risk_owner" value="{{ $riskAssessment->risk_owner }}">
        </div>

        <div class="form-group">
            <label for="mitigation_option">Mitigation Option</label>
            <textarea class="form-control" name="mitigation_option" id="mitigation_option">{{ $riskAssessment->mitigation_option }}</textarea>
        </div>

        <div class="form-group">
            <label for="treatment">Treatment</label>
            <textarea class="form-control" name="treatment" id="treatment">{{ $riskAssessment->treatment }}</textarea>
        </div>


        <button type="submit" class="btn btn-primary">Update Risk Assessment</button>
    </form>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        // Hide all threat and vulnerability options initially
        $('.threat-group-1, .threat-group-2, .threat-group-3').hide(); // Adjust based on your group count
        $('.vulnerability-group-1, .vulnerability-group-2, .vulnerability-group-3').hide(); // Adjust based on your group count

        // Show threats based on selected threat group
        $('#threat_group_id').change(function() {
            const selectedGroupId = $(this).val();
            $('.threat-group-1, .threat-group-2, .threat-group-3').hide(); // Hide all first
            $('.threat-group-' + selectedGroupId).show(); // Show only selected
            $('#threat_id').val(''); // Reset threat selection
        });

        // Show vulnerabilities based on selected vulnerability group
        $('#vulnerability_group_id').change(function() {
            const selectedGroupId = $(this).val();
            $('.vulnerability-group-1, .vulnerability-group-2, .vulnerability-group-3').hide(); // Hide all first
            $('.vulnerability-group-' + selectedGroupId).show(); // Show only selected
            $('#vulnerability_id').val(''); // Reset vulnerability selection
        });
    });
</script>
@endsection

@endsection

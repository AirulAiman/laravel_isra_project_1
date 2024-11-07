@extends('base.layout')

@section('content')
@include('navbar.layout')
<div class="container">
    <h1>Risk Assessments</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('risk_assessment.create') }}" class="btn btn-primary mb-3">Add New Risk Assessment</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Asset Name</th>
                <th>Confidentiality</th>
                <th>Integrity</th>
                <th>Availability</th>
                <th>CIA Score</th>
                <th>Threat Group</th>
                <th>Threat</th>
                <th>Vulnerability Group</th>
                <th>Vulnerability</th>
                <th>Likelihood</th>
                <th>Impact</th>
                <th>Risk Level</th>
                <th>Risk Owner</th>
                <th>Personnel</th>
                <th>Mitigation Option</th>
                <th>Treatment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riskAssessments as $assessment)
                <tr>
                    <td>{{ $assessment->assetRegister->asset_name }}</td>
                    <td>{{ $assessment->confidentiality }}</td>
                    <td>{{ $assessment->integrity }}</td>
                    <td>{{ $assessment->availability }}</td>
                    <td>{{ $assessment->cia_score }}
                    <td>{{ $assessment->threatGroup->name ?? 'N/A' }}</td>
                    <td>{{ $assessment->threat->name ?? 'N/A' }}</td>
                    <td>{{ $assessment->vulnerabilityGroup->name ?? 'N/A' }}</td>
                    <td>{{ $assessment->vulnerability->name ?? 'N/A' }}</td>
                    <td>{{ $assessment->personnel }}</td>
                    <td>{{ $assessment->likelihood }}</td>
                    <td>{{ $assessment->impact }}</td>
                    <td>{{ $assessment->risk_level }}</td>
                    <td>{{ $assessment->risk_owner }}</td>
                    <td>{{ $assessment->mitigation_option }}</td>
                    <td>{{ $assessment->treatment }}</td>
                    <td>
                        <a href="{{ route('risk_assessment.edit', $assessment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('risk_assessment.destroy', $assessment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confidentialityInput = document.getElementById('confidentiality');
        const integrityInput = document.getElementById('integrity');
        const availabilityInput = document.getElementById('availability');
        const ciaScoreCategoryInput = document.getElementById('cia_score_category');

        function updateCIAScoreCategory() {
            const confidentiality = parseInt(confidentialityInput.value) || 0;
            const integrity = parseInt(integrityInput.value) || 0;
            const availability = parseInt(availabilityInput.value) || 0;

            const totalScore = confidentiality + integrity + availability;

            let category;
            if (totalScore <= 3) {
                category = "LOW"; // Low
            } else if (totalScore <= 6) {
                category = "Medium"; // Medium
            } else if (totalScore <= 9) {
                category = "High"; // High
            } else {
                category = ""; // Clear category
            }

            ciaScoreCategoryInput.value = category;
        }

        confidentialityInput.addEventListener('input', updateCIAScoreCategory);
        integrityInput.addEventListener('input', updateCIAScoreCategory);
        availabilityInput.addEventListener('input', updateCIAScoreCategory);
    });
</script>
@endsection
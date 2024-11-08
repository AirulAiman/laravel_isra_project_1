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

    {{-- <a href="{{ route('risk_assessment.create') }}" class="btn btn-primary mb-3">Add New Risk Assessment</a> --}}

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Asset Name</th>
                    <th>Confidentiality</th>
                    <th>Integrity</th>
                    <th>Availability</th>
                    <th>CIA Score</th>
                    <th>Threat Details</th>
                    <th>Vulnerability Details</th>
                    <th>Likelihood</th>
                    <th>Probability</th>
                    <th>Impact</th>
                    <th>Impact Level</th>
                    <th>Final Risk Level</th>
                    <th>Risk Owner</th>
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
                        <td>{{ $assessment->cia_score }}</td>
                        <td>
                            <strong>Group:</strong> {{ $assessment->threatGroup->name ?? 'N/A' }}<br>
                            <strong>Threat:</strong> {{ $assessment->threat->name ?? 'N/A' }}
                        </td>
                        <td>
                            <strong>Group:</strong> {{ $assessment->vulnerabilityGroup->name ?? 'N/A' }}<br>
                            <strong>Vulnerability:</strong> {{ $assessment->vulnerability->name ?? 'N/A' }}
                        </td>
                        <td>
                            {{ $assessment->likelihood }}
                            @php
                                $likelihoodScore = [
                                    'High' => 3,
                                    'Medium' => 2,
                                    'Low' => 1
                                ][$assessment->likelihood] ?? 'N/A';
                            @endphp
                            <span class="badge bg-secondary">Score: {{ $likelihoodScore }}</span>
                        </td>
                        <td>
                            {{ $assessment->probability }}
                            @php
                                $probabilityScore = [
                                    'Most likely' => 3,
                                    'Once in a while' => 2,
                                    'No probability' => 1
                                ][$assessment->probability] ?? 'N/A';
                            @endphp
                            <span class="badge bg-secondary">Score: {{ $probabilityScore }}</span>
                        </td>
                        <td>{{ $assessment->cia_impact_score }}</td>
                        <td>
                            <span class="badge bg-{{ $assessment->impact_level === 'High' ? 'danger' : ($assessment->impact_level === 'Medium' ? 'warning' : 'success') }}">
                                {{ $assessment->impact_level }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $assessment->final_risk_level === 'High' ? 'danger' : ($assessment->final_risk_level === 'Medium' ? 'warning' : 'success') }}">
                                {{ $assessment->final_risk_level }}
                            </span>
                        </td>
                        <td>{{ $assessment->risk_owner }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $assessment->id }}">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <a href="{{ route('risk_assessments.edit', $assessment->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('risk_assessments.destroy', $assessment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this assessment?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>

                            <!-- Details Modal -->
                            <div class="modal fade" id="detailsModal{{ $assessment->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $assessment->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailsModalLabel{{ $assessment->id }}">Risk Assessment Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Basic Information</h6>
                                                    <p><strong>Asset:</strong> {{ $assessment->assetRegister->asset_name }}</p>
                                                    <p><strong>Risk Owner:</strong> {{ $assessment->risk_owner }}</p>
                                                    <p><strong>Personnel:</strong> {{ $assessment->personnel }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Scoring Details</h6>
                                                    <p><strong>Confidentiality:</strong> {{ $assessment->confidentiality }}</p>
                                                    <p><strong>Integrity:</strong> {{ $assessment->integrity }}</p>
                                                    <p><strong>Availability:</strong> {{ $assessment->availability }}</p>
                                                    <p><strong>CIA Score:</strong> {{ $assessment->cia_score }}</p>
                                                    <p><strong>Impact Level:</strong> {{ $assessment->impact_level }}</p>
                                                    <p><strong>Final Risk Level:</strong> {{ $assessment->final_risk_level }}</p>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <h6>Mitigation & Treatment</h6>
                                                    <p><strong>Mitigation Option:</strong> {{ $assessment->mitigation_option }}</p>
                                                    <p><strong>Treatment:</strong> {{ $assessment->treatment }}</p>
                                                    <p><strong>Actions:</strong> {{ $assessment->actions }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Initialize popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        });

        // CIA Score calculation
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
                category = "LOW";
            } else if (totalScore <= 6) {
                category = "Medium";
            } else if (totalScore <= 9) {
                category = "High";
            } else {
                category = "";
            }

            ciaScoreCategoryInput.value = category;
        }

        if (confidentialityInput && integrityInput && availabilityInput) {
            confidentialityInput.addEventListener('input', updateCIAScoreCategory);
            integrityInput.addEventListener('input', updateCIAScoreCategory);
            availabilityInput.addEventListener('input', updateCIAScoreCategory);
        }
    });
</script>
@endsection
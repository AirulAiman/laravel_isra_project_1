@extends('base.layout')

@section('content')

@include('navbar.layout')



<div class="container">
    <h1>Risk Assessments</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-dark">
        <thead>
            <tr>
                <th>Asset Id</th>
                <th>Asset</th>
                <th>Confidentiality</th>
                <th>Integrity</th>
                <th>Availability</th>
                <th>Threat Group</th>
                <th>Threat</th>
                <th>Vulnerability Group</th>
                <th>Vulnerability</th>
                <th>Personnel</th>
                <th>Likelihood</th>
                <th>Impact</th>
                <th>Risk Level</th>
                <th>Risk Owner</th>
                <th>Mitigation Option</th>
                <th>Treatment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($riskAssessments->isEmpty())
                <tr>
                    <td colspan="17" class="text-center">No Risk Assessments Found</td>
                </tr>
            @else
                @foreach($riskAssessments as $riskAssessment)
                    <tr>
                        <td>{{$riskAssessment->asset_id}}</td>
                        <td>{{ $assetNames[$riskAssessment->asset_id]->asset_name ?? 'N/A' }}</td>
                        <td>{{ $riskAssessment->confidentiality }}</td>
                        <td>{{ $riskAssessment->integrity }}</td>
                        <td>{{ $riskAssessment->availability }}</td>
                        <td>{{ $riskAssessment->threatGroup->name ?? 'N/A' }}</td>
                        <td>{{ $riskAssessment->threat->name ?? 'N/A' }}</td>
                        <td>{{ $riskAssessment->vulnerabilityGroup->name ?? 'N/A' }}</td>
                        <td>{{ $riskAssessment->vulnerability->name ?? 'N/A' }}</td>
                        <td>{{ $riskAssessment->personnel }}</td>
                        <td>{{ $riskAssessment->likelihood }}</td>
                        <td>{{ $riskAssessment->impact }}</td>
                        <td>{{ $riskAssessment->risk_level }}</td>
                        <td>{{ $riskAssessment->risk_owner }}</td>
                        <td>{{ $riskAssessment->mitigation_option }}</td>
                        <td>{{ $riskAssessment->treatment }}</td>
                        <td>
                            <a href="{{ route('risk_assessments.edit', $riskAssessment->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('risk_assessments.destroy', $riskAssessment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    {{ $riskAssessments->links() }}
</div>

@endsection

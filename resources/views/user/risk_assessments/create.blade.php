@extends('base.layout')

@section('title', 'Create Risk Assessment')

@section('content')
@include('navbar.layout')

<div class="container">
    <h1>Create Risk Assessment</h1>

    <form action="{{ route('risk_assessments.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="asset_id">Asset</label>
            <select name="asset_id" class="form-control" required>
                @foreach($assets as $asset)
                    <option value="{{ $asset->asset_id }}">{{ $asset->asset_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="threat_group_id">Threat Group</label>
            <select name="threat_group_id" class="form-control" id="threatGroupSelect" required>
                <option value="">Select Threat Group</option>
                @foreach($threatGroups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="threat_id">Threat</label>
            <select name="threat_id" class="form-control" id="threatSelect" required>
                <option value="">Select Threat</option>
                @foreach($threatGroups as $group)
                    @foreach($group->threats as $threat)
                        <option value="{{ $threat->id }}" class="group-{{ $group->id }}" style="display:none;">
                            {{ $threat->name }}
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="vulnerability_group_id">Vulnerability Group</label>
            <select name="vulnerability_group_id" class="form-control" id="vulnerabilityGroupSelect" required>
                <option value="">Select Vulnerability Group</option>
                @foreach($vulnerabilityGroups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="vulnerability_id">Vulnerability</label>
            <select name="vulnerability_id" class="form-control" id="vulnerabilitySelect" required>
                <option value="">Select Vulnerability</option>
                @foreach($vulnerabilityGroups as $group)
                    @foreach($group->vulnerabilities as $vulnerability)
                        <option value="{{ $vulnerability->id }}" class="vgroup-{{ $group->id }}" style="display:none;">
                            {{ $vulnerability->name }}
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Risk Assessment</button>
    </form>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const threatGroupSelect = document.getElementById('threatGroupSelect');
        const threatSelect = document.getElementById('threatSelect');
        const vulnerabilityGroupSelect = document.getElementById('vulnerabilityGroupSelect');
        const vulnerabilitySelect = document.getElementById('vulnerabilitySelect');

        threatGroupSelect.addEventListener('change', function () {
            const selectedGroupId = this.value;
            const options = threatSelect.options;

            for (let i = 0; i < options.length; i++) {
                options[i].style.display = 'none';
                if (options[i].classList.contains('group-' + selectedGroupId)) {
                    options[i].style.display = 'block';
                }
            }

            threatSelect.value = ""; // Reset threat select
        });

        vulnerabilityGroupSelect.addEventListener('change', function () {
            const selectedGroupId = this.value;
            const options = vulnerabilitySelect.options;

            for (let i = 0; i < options.length; i++) {
                options[i].style.display = 'none';
                if (options[i].classList.contains('vgroup-' + selectedGroupId)) {
                    options[i].style.display = 'block';
                }
            }

            vulnerabilitySelect.value = ""; // Reset vulnerability select
        });
    });
</script>
@endsection

@endsection

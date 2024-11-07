@if($vulnerabilities->isEmpty())
    <option value="">No vulnerabilities available</option>
@else
    @foreach($vulnerabilities as $vulnerability)
        <option value="{{ $vulnerability->id }}" {{ isset($selectedVulnerabilityId) && $selectedVulnerabilityId == $vulnerability->id ? 'selected' : '' }}>
            {{ $vulnerability->name }}
        </option>
    @endforeach
@endif
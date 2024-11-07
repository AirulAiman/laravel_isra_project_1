<div class="form-group">
    <label for="asset_id">Asset</label>
    <select name="asset_id" class="form-control" required>
        @foreach($assets as $asset)
            <option value="{{ $asset->asset_id }}" {{ isset($riskAssessment) && $riskAssessment->asset_id == $asset->asset_id ? 'selected' : '' }}>
                {{ $asset->asset_name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="vulnerability_id">Vulnerability</label>
    <select name="vulnerability_id" class="form-control" required>
        @foreach($vulnerabilities as $vulnerability)
            <option value="{{ $vulnerability->id }}" {{ isset($riskAssessment) && $riskAssessment->vulnerability_id == $vulnerability->id ? 'selected' : '' }}>
                {{ $vulnerability->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="threat_id">Threat</label>
    <select name="threat_id" class="form-control" required>
        @foreach($threats as $threat)
            <option value="{{ $threat->id }}" {{ isset($riskAssessment) && $riskAssessment->threat_id == $threat->id ? 'selected' : '' }}>
                {{ $threat->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="confidentiality">Confidentiality (1-5)</label>
    <input type="number" name="confidentiality" class="form-control" value="{{ isset($riskAssessment) ? $riskAssessment->confidentiality : old('confidentiality') }}" required min="1" max="5">
</div>

<div class="form-group">
    <label for="integrity">Integrity (1-5)</label>
    <input type="number" name="integrity" class="form-control" value="{{ isset($riskAssessment) ? $riskAssessment->integrity : old('integrity') }}" required min="1" max="5">
</div>

<div class="form-group">
    <label for="availability">Availability (1-5)</label>
    <input type="number" name="availability" class="form-control" value="{{ isset($riskAssessment) ? $riskAssessment->availability : old('availability') }}" required min="1" max="5">
</div>

<div class="form-group">
    <label for="personnel">Personnel</label>
    <input type="text" name="personnel" class="form-control" value="{{ isset($riskAssessment) ? $riskAssessment->personnel : old('personnel') }}" required>
</div>

<div class="form-group">
    <label for="start_time">Start Time</label>
    <input type="datetime-local" name="start_time" class="form-control" value="{{ isset($riskAssessment) ? $riskAssessment->start_time->format('Y-m-d\TH:i') : old('start_time') }}" required>
</div>

<div class="form-group">
    <label for="end_time">End Time</label>
    <input type="datetime-local" name="end_time" class="form-control" value="{{ isset($riskAssessment) && $riskAssessment->end_time ? $riskAssessment->end_time->format('Y-m-d\TH:i') : old('end_time') }}">
</div>

<div class="form-group">
    <label for="likelihood">Likelihood</label>
    <select name="likelihood" class="form-control" required>
        <option value="Low" {{ isset($riskAssessment) && $riskAssessment->likelihood == 'Low' ? 'selected' : '' }}>Low</option>
        <option value="Medium" {{ isset($riskAssessment) && $riskAssessment->likelihood == 'Medium' ? 'selected' : '' }}>Medium</option>
        <option value="High" {{ isset($riskAssessment) && $riskAssessment->likelihood == 'High' ? 'selected' : '' }}>High</option>
    </select>
</div>

<div class="form-group">
    <label for="impact">Impact</label>
    <select name="impact" class="form-control" required>
        <option value="Low" {{ isset($riskAssessment) && $riskAssessment->impact == 'Low' ? 'selected' : '' }}>Low</option>
        <option value="Medium" {{ isset($riskAssessment) && $riskAssessment->impact == 'Medium' ? 'selected' : '' }}>Medium</option>
        <option value="High" {{ isset($riskAssessment) && $riskAssessment->impact == 'High' ? 'selected' : '' }}>High</option>
    </select>
</div>

<div class="form-group">
    <label for="risk_level">Risk Level</label>
    <select name="risk_level" class="form-control" required>
        <option value="Low" {{ isset($riskAssessment) && $riskAssessment->risk_level == 'Low' ? 'selected' : '' }}>Low</option>
        <option value="Medium" {{ isset($riskAssessment) && $riskAssessment->risk_level == 'Medium' ? 'selected' : '' }}>Medium</option>
        <option value="High" {{ isset($riskAssessment) && $riskAssessment->risk_level == 'High' ? 'selected' : '' }}>High</option>
    </select>
</div>

<div class="form-group">
    <label for="risk_owner">Risk Owner</label>
    <input type="text" name="risk_owner" class="form-control" value="{{ isset($riskAssessment) ? $riskAssessment->risk_owner : old('risk_owner') }}" required>
</div>

<div class="form-group">
    <label for="mitigation_option">Mitigation Option</label>
    <textarea name="mitigation_option" class="form-control" required>{{ isset($riskAssessment) ? $riskAssessment->mitigation_option : old('mitigation_option') }}</textarea>
</div>

<div class="form-group">
    <label for="treatment">Treatment</label>
    <textarea name="treatment" class="form-control">{{ isset($riskAssessment) ? $riskAssessment->treatment : old('treatment') }}</textarea>
</div>

{{-- resources/views/partials/threats.blade.php --}}
@if($threats->isEmpty())
    <option value="">No threats available</option>
@else
    @foreach($threats as $threat)
        <option value="{{ $threat->id }}" {{ isset($selectedThreatId) && $selectedThreatId == $threat->id ? 'selected' : '' }}>
            {{ $threat->name }}
        </option>
    @endforeach
@endif
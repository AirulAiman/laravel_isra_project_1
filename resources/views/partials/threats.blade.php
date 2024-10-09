{{-- resources/views/partials/threats.blade.php --}}
@if($threats->isEmpty())
    <option value="">No Threats Available</option>
@else
    @foreach($threats as $threat)
        <option value="{{ $threat->id }}">{{ $threat->name }}</option>
    @endforeach
@endif
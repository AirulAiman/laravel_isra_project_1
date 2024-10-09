{{-- resources/views/partials/vulnerabilities.blade.php --}}
@if($vulnerabilities->isEmpty())
    <option value="">No Vulnerabilities Available</option>
@else
    @foreach($vulnerabilities as $vulnerability)
        <option value="{{ $vulnerability->id }}">{{ $vulnerability->name }}</option>
    @endforeach
@endif
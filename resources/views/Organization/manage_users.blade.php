@extends('base.layout')

@section('content')
    <h2>Manage Users for {{ $organization->org_name }}</h2>

    <form action="{{ route('organizations.assignUser', $organization->org_id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id">Assign User</label>
            <select name="user_id" class="form-select">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign User</button>
    </form>
@endsection

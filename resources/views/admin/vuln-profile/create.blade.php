@extends('base.layout')

@section('content')
    <div class="container">
        <h1>Create New Vulnerability</h1>

        <form action="{{ route('vulnerabilities.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Vulnerability Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="vulnerability_group_id" class="form-label">Vulnerability Group</label>
                <select class="form-control" id="vulnerability_group_id" name="vulnerability_group_id" required>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
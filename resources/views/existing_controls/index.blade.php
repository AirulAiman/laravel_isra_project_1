@extends('base.layout')

@section('content')
@include('navbar.layout')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Existing Controls</h1>
        <a href="{{ route('existing-controls.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Control
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Control ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Group</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($controls as $control)
                            <tr>
                                <td>{{ $control->control_id }}</td>
                                <td>{{ $control->name }}</td>
                                <td>{{ $control->description }}</td>
                                <td>{{ $control->controlGroup->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $control->status === 'Active' ? 'success' : 'danger' }}">
                                        {{ $control->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('existing-controls.edit', $control) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('existing-controls.destroy', $control) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this control?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
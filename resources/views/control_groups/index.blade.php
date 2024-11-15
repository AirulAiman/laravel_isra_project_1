@extends('base.layout')

@section('content')
@include('navbar.layout')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Control Groups</h1>
        <a href="{{ route('control-groups.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Group
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Controls Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->description }}</td>
                                <td>{{ $group->controls_count }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('control-groups.show', $group) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> View Controls
                                        </a>
                                        <a href="{{ route('control-groups.edit', $group) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('control-groups.destroy', $group) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this group?')">
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
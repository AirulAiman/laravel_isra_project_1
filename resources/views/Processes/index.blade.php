@extends('base.layout')

@section('content')
@include('navbar.layout')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Processes</h1>
        <a href="{{ route('processes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Process
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
                            <th>Process ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($processes as $process)
                            <tr>
                                <td>{{ $process->process_id }}</td>
                                <td>{{ $process->name }}</td>
                                <td>{{ $process->description }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('processes.edit', $process) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('processes.destroy', $process) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this process?')">
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
@extends('base.layout')

@section('content')
@include('navbar.layout')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">
            <h2>{{ $controlGroup->name }}</h2>
            <p class="mb-0">{{ $controlGroup->description }}</p>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('control-groups.update-controls', $controlGroup) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Assign Controls to Group</label>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 50px;">Select</th>
                                    <th>Control ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($availableControls as $control)
                                    <tr>
                                        <td>
                                            <input type="checkbox" 
                                                   name="control_ids[]" 
                                                   value="{{ $control->id }}"
                                                   {{ $control->control_group_id == $controlGroup->id ? 'checked' : '' }}
                                                   class="form-check-input">
                                        </td>
                                        <td>{{ $control->control_id }}</td>
                                        <td>{{ $control->name }}</td>
                                        <td>{{ $control->description }}</td>
                                        <td>
                                            <span class="badge bg-{{ $control->status === 'Active' ? 'success' : 'danger' }}">
                                                {{ $control->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('control-groups.index') }}" class="btn btn-secondary">Back to Groups</a>
                    <button type="submit" class="btn btn-primary">Update Controls</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
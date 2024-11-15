@extends('base.layout')

@section('content')
@include('navbar.layout')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Edit Process {{ $process->process_id }}</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('processes.update', $process) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $process->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $process->description) }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('processes.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Process</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
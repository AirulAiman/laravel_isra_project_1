@extends('base.layout')

@section('title', 'Asset Register')

@section('content')
@include('navbar.layout')

<div class="container">
    <h1>Asset Register</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <a href="{{ route('assets.create') }}" class="btn btn-primary">Add Asset</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Asset ID</th>
                <th>Asset Name</th>
                <th>Asset Description</th>
                <th>Asset Category</th>
                <th>Asset Owner</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assets as $asset)
                <tr>
                    <td>{{ $asset->asset_id }}</td>
                    <td>{{ $asset->asset_name }}</td>
                    <td>{{ $asset->asset_desc }}</td>
                    <td>{{ $asset->asset_category }}</td>
                    <td>{{ $asset->asset_owner }}</td>
                    <td>
                        <a href="{{ route('assets.edit', $asset->asset_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('assets.destroy', $asset->asset_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

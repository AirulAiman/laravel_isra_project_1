@extends('base.layout')

@section('content')
@include('navbar.layout')
<div class="container">
    <h1>Asset Register</h1>
    
    <a href="{{ route('asset_register.create') }}" class="btn btn-primary mb-3">Add New Asset</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Asset Name</th>
                <th>Serial No</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Owner</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assets as $asset)
            <tr>
                <td>{{ $asset->asset_name }}</td>
                <td>{{ $asset->asset_serial_no }}</td>
                <td>{{ $asset->asset_category }}</td>
                <td>{{ $asset->asset_qty }}</td>
                <td>{{ $asset->asset_owner }}</td>
                <td>{{ $asset->asset_location }}</td>
                <td>
                    <a href="{{ route('asset_register.edit', $asset->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('asset_register.destroy', $asset->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

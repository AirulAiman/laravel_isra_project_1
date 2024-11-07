@extends('base.layout')

@section('title', 'Edit Asset')

@section('content')
@include('navbar.layout')

<div class="container">
    <h1>Edit Asset</h1>

    <form action="{{ route('assets.update', $asset->asset_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="asset_name">Asset Name</label>
            <input type="text" name="asset_name" value="{{ $asset->asset_name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="asset_desc">Asset Description</label>
            <textarea name="asset_desc" class="form-control">{{ $asset->asset_desc }}</textarea>
        </div>

        <div class="form-group">
            <label for="asset_serial_no">Asset Serial No</label>
            <input type="text" name="asset_serial_no" value="{{ $asset->asset_serial_no }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="asset_category">Asset Category</label>
            <select name="asset_category" class="form-control" required>
                <option value="Process" {{ $asset->asset_category == 'Process' ? 'selected' : '' }}>Process</option>
                <option value="Data & Information" {{ $asset->asset_category == 'Data & Information' ? 'selected' : '' }}>Data & Information</option>
                <option value="Hardware" {{ $asset->asset_category == 'Hardware' ? 'selected' : '' }}>Hardware</option>
                <option value="Software" {{ $asset->asset_category == 'Software' ? 'selected' : '' }}>Software</option>
                <option value="Service" {{ $asset->asset_category == 'Service' ? 'selected' : '' }}>Service</option>
                <option value="People" {{ $asset->asset_category == 'People' ? 'selected' : '' }}>People</option>
                <option value="Premise" {{ $asset->asset_category == 'Premise' ? 'selected' : '' }}>Premise</option>
            </select>
        </div>

        <div class="form-group">
            <label for="asset_qty">Asset Quantity</label>
            <input type="number" name="asset_qty" value="{{ $asset->asset_qty }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="asset_owner">Asset Owner</label>
            <input type="text" name="asset_owner" value="{{ $asset->asset_owner }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="asset_location">Asset Location</label>
            <input type="text" name="asset_location" value="{{ $asset->asset_location }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection

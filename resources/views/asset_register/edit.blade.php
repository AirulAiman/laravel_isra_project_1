@extends('base.layout')

@section('content')
<div class="container">
    <h1>Edit Asset</h1>

    <form action="{{ route('asset_register.update', $asset_register->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="asset_name">Asset Name</label>
            <input type="text" name="asset_name" class="form-control" value="{{ $asset_register->asset_name }}" required>
        </div>

        <div class="form-group">
            <label for="asset_serial_no">Asset Serial Number</label>
            <input type="text" name="asset_serial_no" class="form-control" value="{{ $asset_register->asset_serial_no }}" required>
        </div>

        <div class="form-group">
            <label for="asset_category">Asset Category</label>
            <select name="asset_category" class="form-control" required>
                <option value="Process" {{ $asset_register->asset_category == 'Process' ? 'selected' : '' }}>Process</option>
                <option value="Data & Information" {{ $asset_register->asset_category == 'Data & Information' ? 'selected' : '' }}>Data & Information</option>
                <option value="Hardware" {{ $asset_register->asset_category == 'Hardware' ? 'selected' : '' }}>Hardware</option>
                <option value="Software" {{ $asset_register->asset_category == 'Software' ? 'selected' : '' }}>Software</option>
                <option value="Service" {{ $asset_register->asset_category == 'Service' ? 'selected' : '' }}>Service</option>
                <option value="People" {{ $asset_register->asset_category == 'People' ? 'selected' : '' }}>People</option>
                <option value="Premise" {{ $asset_register->asset_category == 'Premise' ? 'selected' : '' }}>Premise</option>
            </select>
        </div>

        <div class="form-group">
            <label for="asset_qty">Quantity</label>
            <input type="number" name="asset_qty" class="form-control" value="{{ $asset_register->asset_qty }}" required>
        </div>

        <div class="form-group">
            <label for="asset_owner">Asset Owner</label>
            <input type="text" name="asset_owner" class="form-control" value="{{ $asset_register->asset_owner }}" required>
        </div>

        <div class="form-group">
            <label for="asset_location">Asset Location</label>
            <input type="text" name="asset_location" class="form-control" value="{{ $asset_register->asset_location }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Asset</button>
    </form>
</div>
@endsection

@extends('base.layout')

@section('content')
<div class="container">
    <h1>Add New Asset</h1>

    <form action="{{ route('asset_register.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="asset_name">Asset Name</label>
            <input type="text" name="asset_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="asset_serial_no">Asset Serial Number</label>
            <input type="text" name="asset_serial_no" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="asset_category">Asset Category</label>
            <select name="asset_category" class="form-control" required>
                <option value="Process">Process</option>
                <option value="Data & Information">Data & Information</option>
                <option value="Hardware">Hardware</option>
                <option value="Software">Software</option>
                <option value="Service">Service</option>
                <option value="People">People</option>
                <option value="Premise">Premise</option>
            </select>
        </div>

        <div class="form-group">
            <label for="asset_qty">Quantity</label>
            <input type="number" name="asset_qty" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="asset_owner">Asset Owner</label>
            <input type="text" name="asset_owner" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="asset_location">Asset Location</label>
            <input type="text" name="asset_location" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save Asset</button>
    </form>
</div>
@endsection

@extends('base.layout')
@section('title', 'ISRA')

@section('content')
    @include('navbar.layout')

    <div class="container">
        <div class="align-items-center justify-content-center my-5">
            <div class="container text-center fw-bold fs-2 my-5">
                <p>Organization Listings</p>
            </div>
        </div>
    </div>

    @include('admin.organizations.components.create')
    <div class="container">
        <div class="container d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#create-org">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>

    <div class="container">
        <div class="container my-5">
            @include('admin.organizations.components.table')
        </div>
    </div>
@endsection

<style>
    .inline {
        display: inline;
    }
</style>

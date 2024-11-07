@extends('base.layout')
@section('title', 'ISRA')

@section('content')

    {{-- NAVBAR --}}
    @include('navbar.layout')

    {{-- TITLE --}}
    <div class="align-items-center justify-content-center my-5">
        <div class="container text-center fw-bold fs-2 my-5">
            <p>Manage Users</p>
        </div>
    </div>

    {{-- SEARCH BAR --}}
    <div class="container">
        @include('admin.user-management.components.search')
    </div>

    {{-- User Listings --}}
    <div class="container">
        @include('admin.user-management.components.table')
    </div>

@endsection

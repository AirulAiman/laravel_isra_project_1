@extends('base.layout')
@section('title', 'ISRA')

@section('content')
    {{-- NAVBAR --}}
    @include('navbar.layout')

    {{-- TITLE --}}
    <div class="container">
        <div class="align-items-center justify-content-center my-5">
            <div class="container text-center fw-bold fs-2 my-5">
                <p>Organization Listings</p>
            </div>
        </div>
    </div>

    {{-- CREATE PROJECT BUTTON --}}
    <div class="container">
        <div class="container d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#create-org">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>

    {{-- PROJECT LISTING TABLE --}}
    <div class="container">
        <div class="container my-5">
            <table class="table table-striped">

                <thead>
                    <tr>
                        <th scope="col">Organization ID</th>
                        <th scope="col">Organization Name</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($organizations as $org)
                        <tr>
                            <td>{{ $org->org_id }}</td>
                            <td>{{ $org->org_name }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#view-org-{{ $org->org_id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- VIEW PROJECT DETAIL MODAL --}}
                        @include('admin.organizations.detail')
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    {{-- CREATE PROJECT MODAL --}}
    @include('admin.organizations.create')



@endsection

<style>
    .inline {
        display: inline;
    }
</style>

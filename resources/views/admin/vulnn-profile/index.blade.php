@extends('base.layout')
@section('title', 'ISRA')

@section('content')

    {{-- NAVBAR --}}
    @include('navbar.layout')

    {{-- TITLE --}}
    <div class="container">
        <div class="align-items-center justify-content-center my-5">
            <div class="container text-center fw-bold fs-2 my-5">
                <p>Vulnerability Profile</p>
            </div>
        </div>
    </div>

    @if ($groupies->isEmpty())
        {{-- CREATE GROUP BUTTON --}}
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="card text-center mb-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Vulnerability Group Unavailable</h5>
                    <p class="card-text">Please create a vulnerability group to assign vulnerabilities.</p>
                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#create-vuln-group">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    @else
        {{-- CREATE BUTTON --}}
        <div class="container mb-4">
            <div class="container d-flex justify-content-end">
                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                    data-bs-target="#create-vuln-group">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>

        {{-- VULN GROUP TABLE --}}
        @include('admin.vulnn-profile.components.table')
    @endif

    {{-- CREATE VULN MODAL --}}
    <div class="modal fade my-5" id="create-vuln-group" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            @include('admin.vulnn-profile.components.create')
        </div>
    </div>

    {{-- EDIT VULN MODAL --}}
    @foreach ($vulns as $vuln)
        <div class="modal fade my-5" id="edit-modal-{{ $vuln->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                @include('admin.vulnn-profile.components.edit')
            </div>
        </div>
        <div class="modal fade my-5" id="delete-confirmation-modal-label-{{ $vuln->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                @include('admin.vulnn-profile.components.delete')
            </div>
        </div>
    @endforeach

@endsection

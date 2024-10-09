@extends('base.layout')
@section('title', 'ISRA')

@section('content')

    {{-- NAVBAR --}}
    @include('navbar.layout')

    {{-- TITLE --}}
    <div class="container">
        <div class="align-items-center justify-content-center my-5">
            <div class="container text-center fw-bold fs-2 my-5">
                <p>Threat Profile</p>
            </div>
        </div>
    </div>

    @if ($groupies->isEmpty())
        {{-- CREATE GROUP BUTTON --}}
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="card text-center mb-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Threat Group Unavailable</h5>
                    <p class="card-text">Please create a threat group to assign threats.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#create-threat-group">
                        Create Threat Group
                    </button>
                </div>
            </div>
        </div>
    @else
        {{-- CREATE BUTTON --}}
        <div class="container mb-4">
            <div class="container d-flex justify-content-end">
                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                    data-bs-target="#create-threat-group">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>

        {{-- THREAT GROUP TABLE --}}
        @include('admin.tthreat-profile.components.table')
    @endif

    {{-- CREATE THREAT MODAL --}}
    <div class="modal fade my-5" id="create-threat-group" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            @include('admin.tthreat-profile.components.create')
        </div>
    </div>

    {{-- EDIT THREAT MODAL --}}
    @foreach ($threats as $threat)
        <div class="modal fade my-5" id="edit-modal-{{ $threat->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                @include('admin.tthreat-profile.components.edit')
            </div>
        </div>
    @endforeach

@endsection

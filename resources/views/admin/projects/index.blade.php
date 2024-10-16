@extends('base.layout')

@section('content')
    <h3>Your Projects</h3>
    <ul>
        @foreach($projects as $project)
            <li>{{ $project->prj_name }} ({{ $project->start_date }} - {{ $project->end_date }})</li>
        @endforeach
    </ul> {{-- TITLE --}}
    <div class="container">
        <div class="align-items-center justify-content-center my-5">
            <div class="container text-center fw-bold fs-2 my-5">
                <p>Project Listings</p>
            </div>
        </div>
    </div>

    {{-- CREATE PROJECT BUTTON --}}
    <div class="container">
        <div class="container d-flex justify-content-end">
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#create-project">
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
                        <th scope="col">Project ID</th>
                        <th scope="col">Project Name</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($projects as $prj)
                        <tr>
                            <td>{{ $prj->prj_id }}</td>
                            <td>{{ $prj->prj_name }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#view-project-{{ $prj->prj_id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- VIEW PROJECT DETAIL MODAL --}}
                        @include('admin.projects.detail')
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    {{-- CREATE PROJECT MODAL --}}
    @include('admin.projects.create')



@endsection

<style>
    .inline {
        display: inline;
    }
</style>

@endsection

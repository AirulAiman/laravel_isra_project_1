@extends('base.layout')

@section('content')
@include('navbar.layout')
<h2>{{ $organization->org_name }} - Projects</h2>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-project">
    Create New Project
</button>

<h3>Projects</h3>
<ul>
    @foreach($organization->projects as $project)
        <li>{{ $project->prj_name }} ({{ $project->start_date }} - {{ $project->end_date }})</li>
    @endforeach
</ul>

<!-- Create Project Modal -->
<div class="modal fade" id="create-project" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('projects.create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="org_id" value="{{ $organization->org_id }}">

                    <div class="mb-3">
                        <label for="prj_name">Project Name</label>
                        <input type="text" name="prj_name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="prj_desc">Description</label>
                        <textarea name="prj_desc" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
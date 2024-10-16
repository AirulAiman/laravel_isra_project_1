@extends('base.layout')

@section('content')
    <div class="container">
       

        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="prj_name">Project Name</label>
                <input type="text" name="prj_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="prj_desc">Project Description</label>
                <textarea name="prj_desc" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Project</button>
        </form>
    </div>
@endsection
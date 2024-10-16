<div>
    <h2>{{ $organization->org_name }}</h2>
    <p>{{ $organization->org_desc }}</p>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-project">
        Create New Project
    </button>

    <h3>Projects</h3>
    <ul>
        @foreach($organization->projects as $project)
            <li>{{ $project->prj_name }} ({{ $project->start_date }} - {{ $project->end_date }})</li>
        @endforeach
    </ul>
</div>

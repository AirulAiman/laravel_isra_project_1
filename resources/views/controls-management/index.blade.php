@extends('base.layout')

@section('content')
@include('navbar.layout')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <!-- Control Groups Section -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Control Groups</h3>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addGroupModal">
                        <i class="fas fa-plus"></i> Add Group
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Controls</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td>
                                            {{ $group->name }}
                                            <small class="d-block text-muted">{{ $group->description }}</small>
                                        </td>
                                        <td>{{ $group->controls_count }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-warning" 
                                                        onclick="editGroup({{ $group->id }}, '{{ $group->name }}', '{{ $group->description }}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('control-groups.destroy', $group) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                            onclick="return confirm('Are you sure you want to delete this group?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Existing Controls Section -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Existing Controls</h3>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addControlModal">
                        <i class="fas fa-plus"></i> Add Control
                    </button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="groupFilter" class="form-label">Filter by Group</label>
                        <select class="form-select" id="groupFilter">
                            <option value="">All Groups</option>
                            @foreach($groups as $group)
                                @if($group->controls_count > 0) <!-- Only show groups with controls -->
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Control ID</th>
                                    <th>Name</th>
                                    <th>Group</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="controlTable">
                                @foreach($controls as $control)
                                    <tr data-group-id="{{ $control->control_group_id }}">
                                        <td>{{ $control->control_id }}</td>
                                        <td>{{ $control->name }}</td>
                                        <td>{{ $control->controlGroup->name }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!-- Action buttons -->
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Group Modal -->
<div class="modal fade" id="addGroupModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Control Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('control-groups.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Group</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Group Modal -->
<div class="modal fade" id="editGroupModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Control Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editGroupForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Group</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Control Modal -->
<div class="modal fade" id="addControlModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Control</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('existing-controls.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="control_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="control_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="control_description" class="form-label">Description</label>
                        <textarea class="form-control" id="control_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="control_group_id" class="form-label">Control Group</label>
                        <select class="form-control" id="control_group_id" name="control_group_id" required>
                            <option value="">Select a group</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Control</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Control Modal -->
<div class="modal fade" id="editControlModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Control</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editControlForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_control_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_control_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_control_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_control_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_control_group_id" class="form-label">Control Group</label>
                        <select class="form-control" id="edit_control_group_id" name="control_group_id" required>
                            <option value="">Select a group</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Control</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.getElementById('groupFilter').addEventListener('change', function() {
    const selectedGroupId = this.value;
    const rows = document.querySelectorAll('#controlTable tr');

    rows.forEach(row => {
        const rowGroupId = row.getAttribute('data-group-id');
        if (selectedGroupId === '' || rowGroupId === selectedGroupId) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
function editGroup(id, name, description) {
    const form = document.getElementById('editGroupForm');
    form.action = `/control-groups/${id}`;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_description').value = description;
    new bootstrap.Modal(document.getElementById('editGroupModal')).show();
}

function editControl(id, name, description, groupId, status) {
    const form = document.getElementById('editControlForm');
    form.action = `/existing-controls/${id}`;
    document.getElementById('edit_control_name').value = name;
    document.getElementById('edit_control_description').value = description;
    document.getElementById('edit_control_group_id').value = groupId;
    // document.getElementById('edit_status').value = status;
    new bootstrap.Modal(document.getElementById('editControlModal')).show();
}
</script>
@endsection
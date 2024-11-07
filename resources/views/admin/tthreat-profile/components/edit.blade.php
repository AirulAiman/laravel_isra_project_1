<div class="modal-content">

    <div class="modal-header">
        <h1 class="modal-title fs-5">Edit Threat Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body text-center">
        <!-- Make the form ID unique by appending the threat ID -->
        <form id="form-edit-threat-{{ $threat->id }}" action="{{ route('threats.update', $threat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Threat ID (display only) -->
            <div class="input-group mt-3">
                <span class="input-group-text">Threat ID</span>
                <input type="text" class="form-control" value="{{ $threat->id }}" disabled readonly>
            </div>

            <!-- Name -->
            <div class="input-group mt-3">
                <span class="input-group-text">Name</span>
                <input type="text" class="form-control" name="name" placeholder="{{ $threat->name }}">
            </div>

            <!-- Description -->
            <div class="input-group mt-3">
                <span class="input-group-text">Description</span>
                <textarea class="form-control" name="description" placeholder="{{ $threat->description }}"></textarea>
            </div>

            <!-- Threat Group -->
            <div class="input-group mt-3">
                <span class="input-group-text">Group</span>
                <select class="form-select" name="threat_group_id">
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" {{ $group->id == $threat->threat_group_id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

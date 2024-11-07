<div class="modal-content">

    <div class="modal-header">
        <h1 class="modal-title fs-5">Edit Vulnerability Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body text-center">
        <form id="form-edit-vuln-{{ $vuln->id }}" action="{{ route('vulnerabilities.update', $vuln->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="input-group mt-3">
                <span class="input-group-text">Vulnerability ID</span>
                <input type="text" class="form-control" value="{{ $vuln->id }}" disabled readonly>
            </div>

            <div class="input-group mt-3">
                <span class="input-group-text">Name</span>
                <input type="text" class="form-control" name="name" placeholder="{{ $vuln->name }}">
            </div>

            <div class="input-group mt-3">
                <span class="input-group-text">Description</span>
                <textarea class="form-control" name="description" placeholder="{{ $vuln->description }}"></textarea>
            </div>

            <div class="input-group mt-3">
                <span class="input-group-text">Group</span>
                <select class="form-select" name="vulnerability_group_id">
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" {{ $group->id == $vuln->vulnerability_group_id ? 'selected' : '' }}>
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

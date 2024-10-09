<div class="modal-content">

    <div class="modal-header">
        <h1 class="modal-title fs-5">Edit Threat Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body text-center">

        <div class="input-group mt-3">
            <span class="input-group-text">Threat ID</span>
            <input type="text" class="form-control" value="{{ $threat->id }}" disabled>
        </div>

        <form id="form-edit-threat" action="{{ route('threats.update', $threat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="input-group mt-3">
                <span class="input-group-text" id="name">Name</span>
                <input type="text" class="form-control" id="name" name="name"
                    placeholder="{{ $threat->name }}" value="{{ $threat->name }}">
            </div>

            <div class="input-group mt-3">
                <span class="input-group-text" id="description">Description</span>
                <textarea type="text" class="form-control" id="description" name="description"
                    placeholder="{{ $threat->description }}" required></textarea>
            </div>

            <div class="input-group mt-3">
                <span class="input-group-text" id="threat-group-id">Group</span>
                <select class="form-select" id="threat_group_id" name="threat_group_id" required>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}"
                            {{ $group->id == $threat->threat_group_id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        </form>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="form-edit-threat">Save</button>
    </div>

</div>

<script>
    document.getElementById('form-edit-threat').addEventListener('submit', function(event) {
        console.log('Form is being submitted');
    });
</script>

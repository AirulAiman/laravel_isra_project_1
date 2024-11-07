<div class="modal fade my-5" id="view-user-{{ $users->user_id }}" tabindex="-1"
    aria-labelledby="userMgmt{{ $users->user_id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="view-user-{{ $users->user_id }}">User Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('user-management.update', $users->user_id) }}" method="POST"
                    enctype="multipart/form-data" id="form-update-umgmt">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-12 my-3">
                            <label class="form-label fw-bold" for="user_id{{ $users->user_id }}">
                                ID:
                            </label>
                            <input class="form-control" type="text" id="user_id{{ $users->user_id }}"
                                placeholder="{{ $users->user_id }}" disabled readonly>
                        </div>
                        <div class="col-12 my-3">
                            <label class="form-label fw-bold">
                                Email:
                            </label>
                            <input class="form-control" type="text" id="email" name="email"
                                placeholder="{{ $users->email }}">
                        </div>
                        <div class="col-12 my-3">
                            <label class="form-label fw-bold">
                                Organization:
                            </label>
                            <select class="form-select" id="user_mgmt_org" name="user_mgmt_org">
                                <option value="">Select organization</option>
                                @foreach ($orgs as $org)
                                    <option value="{{ $org->org_id }}"
                                        {{ $org->org_id == $users->organization ? 'selected' : '' }}>
                                        {{ $org->org_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="form-update-umgmt">Save</button>
            </div>
        </div>
    </div>
</div>

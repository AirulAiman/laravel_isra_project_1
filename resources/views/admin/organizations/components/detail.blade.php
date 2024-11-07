<form id="update-org" action="{{ route('test.organizations.update', $org->org_id) }}" method="POST">
    <div class="modal fade my-5" id="view-org-{{ $org->org_id }}" tabindex="-1" aria-hidden="true"
        aria-labelledby="orgModalLabel{{ $org->org_id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="view-project">Edit Organization Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    {{-- prj desc --}}
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="container d-flex justify-content-center">
                                    <img class="rounded-circle" src="{{ Storage::url($org->org_logo) }}" id="org_logo"
                                        class="img-fluid" style="width: 100px; height: 100px;">
                                </div>

                                <div class="col-12 my-3">
                                    <label class="form-label fw-bold" for="org_id{{ $org->org_id }}">
                                        ID:
                                    </label>
                                    <input class="form-control" type="text" id="org_id{{ $org->org_id }}"
                                        placeholder="{{ $org->org_id }}" disabled readonly>
                                </div>

                                <div class="col-12 my-3">
                                    <label class="form-label fw-bold">
                                        Name:
                                    </label>
                                    <input class="form-control" type="text" id="org_name" name="org_name"
                                        placeholder="{{ $org->org_name }}">
                                </div>

                                <div class="col-12 my-3">
                                    <label class="form-label fw-bold">
                                        Manage Users:
                                    </label>
                                    <br>
                                    <a class="btn btn-primary" href="/admin/user-management/">
                                        Users
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

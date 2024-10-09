@foreach ($groups as $group)
    <div class="container mb-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-secondary">
                <div class="fw-bold">
                    @include('admin.organizations.components.create')
                    <div class="container d-flex justify-content-between align-items-center">
                        <span>{{ $group->name }}</span>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                @if ($group->threats->isEmpty())
                    <div class="text-center">
                        No threats created for this group
                    </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($group->threats as $threat)
                                <tr>
                                    <td>{{ $threat->name }}</td>
                                    <td>{{ $threat->description }}</td>
                                    <td>
                                        {{-- EDIT BUTTON --}}
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal-{{ $threat->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        {{-- DELETE BUTTON --}}
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#delete-confirmation-modal-{{ $threat->id }}">
                                            <i class="fa-solid fa-delete-left"></i>
                                        </button>

                                        {{-- DELETE CONFIRMATION MODAL --}}
                                        <div class="modal fade my-5" id="delete-confirmation-modal-{{ $threat->id }}"
                                            tabindex="-1" aria-hidden="true"
                                            aria-labelledby="delete-confirmation-modal-label-{{ $threat->id }}"
                                            data-bs-target="#delete-confirmation-modal-{{ $threat->id }}">
                                            <div class="modal-dialog">
                                                @include('admin.tthreat-profile.components.delete', [
                                                    'threat' => $threat,
                                                ])
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </li>
        </ul>
    </div>
@endforeach

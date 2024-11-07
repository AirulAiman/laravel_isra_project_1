@foreach ($groups as $group)
    <div class="container mb-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                @include('admin.organizations.components.create')
                <span class="fw-bold">{{ $group->name }}</span>
                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#vulnerabilities-{{ $group->id }}" aria-expanded="false" aria-controls="vulnerabilities-{{ $group->id }}">
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
            </li>
            <div class="collapse" id="vulnerabilities-{{ $group->id }}">
                <li class="list-group-item">
                    @if ($group->vulnerabilities->isEmpty())
                        <div class="text-center">
                            No vulnerabilities created for this group
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
                                @foreach ($group->vulnerabilities as $vulnerability)
                                    <tr>
                                        <td>{{ $vulnerability->name }}</td>
                                        <td>{{ $vulnerability->description }}</td>
                                        <td>
                                            {{-- EDIT BUTTON --}}
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#edit-modal-{{ $vulnerability->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>

                                            {{-- DELETE BUTTON --}}
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete-confirmation-modal-label-{{ $vulnerability->id }}">
                                                <i class="fa-solid fa-delete-left"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </li>
            </div>
        </ul>
    </div>
@endforeach

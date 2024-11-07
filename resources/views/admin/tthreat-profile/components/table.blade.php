@foreach ($groups as $group)
    <div class="container mb-4">
        <ul class="list-group">
            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                @include('admin.organizations.components.create')
                <span class="fw-bold">{{ $group->name }}</span>
                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#threats-{{ $group->id }}" aria-expanded="false" aria-controls="threats-{{ $group->id }}">
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
            </li>
            <div class="collapse" id="threats-{{ $group->id }}">
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
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete-confirmation-modal-label-{{ $threat->id }}">
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

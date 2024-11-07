<div class="container my-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($users === [])
                <tr>
                    <td colspan="4" class="text-center">No users found</td>
                </tr>
            @else
                @if (isset($users) && count($users) > 0)
                    @foreach ($users as $users)
                        <tr>
                            <td>{{ $users->user_id }}</td>
                            <td>{{ $users->name }}</td>
                            <td>{{ $users->email }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#view-user-{{ $users->user_id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @include('admin.user-management.components.details')
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">No users found</td>
                    </tr>
                @endif
            @endif
        </tbody>
    </table>
</div>

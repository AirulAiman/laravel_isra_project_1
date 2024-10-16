<form action="{{ route('admin.organizations.assignUser', $organization->org_id) }}" method="POST">
    @csrf
    <select name="user_id" class="form-select">
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Assign User</button>
</form>

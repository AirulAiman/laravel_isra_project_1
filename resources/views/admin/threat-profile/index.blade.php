@extends('base.layout')

@section('title', 'Create Vulnerability')
@section('content')

    @include('navbar.layout')
    <div class="container">
        <h1>Threats</h1>

        @foreach ($groups as $group)
            <div class="card mb-4">
                <div class="card-header">
                    <h3>{{ $group->name }}</h3>
                </div>
                <div class="card-body">
                    @if ($group->threats->isEmpty())
                        <p>No threats in this group.</p>
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
                                            <!-- Edit and Delete Buttons -->
                                            <a href="{{ route('threats.edit', $threat->id) }}"
                                                class="btn btn-warning btn-sm">Edit
                                            </a>
                                            
                                            <form action="{{ route('threats.destroy', $threat->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this threat?');">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach

        <a href="{{ route('threat-groups.create') }}" class="btn btn-primary">Create New Threat Group</a>
        <a href="{{ route('threats.create') }}" class="btn btn-secondary">Create New Threat</a>

    </div>
@endsection

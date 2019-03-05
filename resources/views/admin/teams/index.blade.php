@extends('layouts.admin')

@section('content')
<div class="container">
    <a class="btn btn-primary mb-4" href="{{ route('admin.teams.create') }}">Add Team</a>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Team Admin</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teams as $team)
                    <tr>
                        <td><a href="/admin/teams/{{ $team->id }}">{{ $team->name }}</a></td>
                        <td>{{ $team->user->name }}</td>
                        <td>
                            
                            <form class="form-inline" method="POST" action="{{ route('admin.teams.destroy', $team) }}">
                                @csrf
                                {{ method_field('DELETE') }}

                                <a href="{{ route('admin.teams.edit', $team) }}" class="btn btn-sm btn-secondary mr-2">Edit</a>

                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">There are no teams yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="container">
    <a class="btn btn-primary mb-4" href="{{ route('admin.users.create') }}">Add User</a>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Account Type</th>
                    <th scope="col">Team</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->account_type }}</td>
                        <td>
                            @if($user->account_type == 'Team Admin')
                                @if(isset($user->team))
                                    <a href="/admin/teams/{{ $user->team->id }}">{{ $user->team->name }}</a>
                                @endif
                            @endif
                        </td>
                        <td>
                            
                            <form class="form-inline" method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                @csrf
                                {{ method_field('DELETE') }}

                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-secondary mr-2">Edit</a>

                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">There are no users yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
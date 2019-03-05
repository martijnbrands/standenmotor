@extends('layouts.admin')

@section('content')
<div class="container">
    <a class="btn btn-primary mb-4" href="{{ route('admin.players.create') }}">Add Player</a>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Team</th>
                    <th scope="col">Goals</th>
                    <th scope="col">Assists</th>
                    <th scope="col">Points</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($players as $player)
                    <tr>
                        <td>{{ $player->name }}</td>
                        <td><a href="/admin/teams/{{ $player->team->id }}">{{ $player->team->name }}</a></td>
                        <td>{{ $player->goals }}</td>
                        <td>{{ $player->assists }}</td>
                        <td>{{ $player->points }}</td>
                        <td>
                            
                            <form class="form-inline" method="POST" action="{{ route('admin.players.destroy', $player) }}">
                                @csrf
                                {{ method_field('DELETE') }}

                                <a href="{{ route('admin.players.edit', $player) }}" class="btn btn-sm btn-secondary mr-2">Edit</a>

                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">There are no players yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
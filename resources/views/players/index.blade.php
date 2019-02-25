@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 mb-4">
            <h2>Players</h2>
        </div>
        <div class="col-sm-4 text-right">
            <a class="btn btn-primary" href="{{ route('players.create') }}">Add Player</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Goals</th>
                    <th scope="col">Assists</th>
                    <th scope="col">Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                    <tr>
                        <td>{{ $player->id }}</td>
                        <td>{{ $player->name }}</td>
                        <td>{{ $player->goals }}</td>
                        <td>{{ $player->assists }}</td>
                        <td>{{ $player->points }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

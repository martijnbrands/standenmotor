@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Goals</th>
                <th scope="col">Assists</th>
                <th scope="col">Points</th>
            </tr>
        </thead>
        <tbody>
            @forelse($players as $player)
            <tr>
                <td>{{ $player->name }}</td>
                <td>{{ $player->goals }}</td>
                <td>{{ $player->assists }}</td>
                <td>{{ $player->points }}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="4">There are no players to show.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    </div>
</div>
@endsection
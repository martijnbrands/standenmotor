@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>Players</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Goals</th>
                    <th scope="col">Assists</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                    <tr>
                        <td>{{ $player->name }}</td>
                        <td>{{ $player->goals }}</td>
                        <td>{{ $player->assists }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

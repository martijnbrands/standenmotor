@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>Teams</h2>
        <hr>
        <a class="btn btn-primary" href="{{ route('teams.create') }}">Team toevoegen</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Naam</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $team)
                    <tr>
                        <td>{{ $team->name }}</td>
                        <td>{{ $team->admin->name }}</td>
                        <td>
                            <a class="btn btn-secondary" href="{{ route('teams.edit', $team) }}">Bewerken</a>
                            <form method="POST" action="{{ route('teams.delete', $team) }}">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">Verwijderen</button>    
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

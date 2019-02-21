@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Team bewerken</h2>
    <form method="POST" action="{{ route('teams.update', $team) }}">
        @csrf
        {{ method_field('patch') }}

        <div class="form-group">
            <label for="teamName">Naam</label>
            <input type="text" class="form-control" id="teamName" name="teamName" value="{{ $team->name }}" placeholder="Team naam">
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Team toevoegen</h2>
    <form method="POST" action="/teams/create">
        @csrf

        <div class="form-group">
            <label for="teamName">Naam</label>
            <input type="text" class="form-control" id="teamName" name="teamName" placeholder="Team naam">
        </div>

        <button type="submit" class="btn btn-primary">Toevoegen</button>
    </form>
</div>
@endsection
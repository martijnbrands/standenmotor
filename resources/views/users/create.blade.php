@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gebruiker toevoegen</h2>
    <form method="POST" action="/users/create">
        @csrf

        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Naam" value="{{ old('name') ? old('name') : '' }}">
            @if ($errors->has('name'))
                <p>{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email adres" value="{{ old('email') ? old('email') : '' }}">
            @if ($errors->has('email'))
                <p>{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="team">Team</label>
            <select class="form-control" name="team_id">
                <option value="">Kies een team</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" @if(old('team_id') == $team->id ) selected @endif>{{ $team->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('team_id'))
                <p>{{ $errors->first('team_id') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="team_admin"><input type="checkbox" id="team_admin" name="team_admin"> Team admin</label>
        </div>

        <div class="form-group">
            <label for="password">Wachtwoord</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Wachtwoord">
            @if ($errors->has('password'))
                <p>{{ $errors->first('password') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="password-confirm">Wachtwoord bevestigen</label>
            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Wachtwoord">
        </div>

        <button type="submit" class="btn btn-primary">Toevoegen</button>
    </form>
</div>
@endsection
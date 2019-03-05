@extends('layouts.admin')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.players.update', $player) }}">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $player->name ? $player->name : '' }}">
            @if ($errors->has('name'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="team_id">Team</label>
            <select class="form-control" name="team_id">
                <option value="" selected>Choose Team</option>
                @foreach($teams as $team)
                    @if (old('team_id') == $team)
                        <option selected value="{{ $team->id }}">{{ $team->name }}</option>
                    @elseif ($player->team->id == $team->id)
                        <option selected value="{{ $team->id }}">{{ $team->name }}</option>
                    @else
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('team_id'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('team_id') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="goals">Goals</label>
            <input type="text" class="form-control" id="goals" name="goals" placeholder="Goals" value="{{ $player->goals ? $player->goals : '0' }}">
            @if ($errors->has('goals'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('goals') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="assists">Assists</label>
            <input type="text" class="form-control" id="assists" name="assists" placeholder="Assists" value="{{ $player->assists ? $player->assists : '0' }}">
            @if ($errors->has('assists'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('assists') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="points">Points</label>
            <input type="text" class="form-control" id="points" name="points" placeholder="Points" value="{{ $player->points ? $player->points : '0' }}">
            @if ($errors->has('points'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('points') }}
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Save Player</button>
    </form>
</div>
@endsection
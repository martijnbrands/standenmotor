@extends('layouts.admin')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.teams.update', $team) }}">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $team->name ? $team->name : '' }}">
            @if ($errors->has('name'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="team_admin">Team Admin</label>
            <select class="form-control" name="team_admin">
                @if(isset($team->user))
                    <option value="{{ $team->user->id }}" selected>{{ $team->user->name }}, [ {{ $team->user->email }} ]</option>
                @endif
                @forelse($teamAdmins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->name }}, [ {{ $admin->email }} ]</option>
                @empty
                    <option>Create more team admins to choose from.</option>
                @endforelse
            </select>
            @if ($errors->has('team_admin'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('team_admin') }}
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Save Team</button>
    </form>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.teams.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') ? old('name') : '' }}">
            @if ($errors->has('name'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="team_admin">Team Admin</label>
            <select class="form-control" name="team_admin">
                <option value="" selected>Choose Team Admin</option>
                @forelse($teamAdmins as $admin)
                    @if (old('team_id') == $admin->id)
                        <option selected value="{{ $admin->id }}">{{ $admin->name }}, [ {{ $admin->email }} ]</option>
                    @else
                        <option value="{{ $admin->id }}">{{ $admin->name }}, [ {{ $admin->email }} ]</option>
                    @endif
                @empty
                    <option disabled>Create more team admins to choose from.</option>
                @endforelse
            </select>
            @if ($errors->has('team_admin'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('team_admin') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="teamId">Team ID</label>
            <input type="text" class="form-control" id="teamId" name="teamId" placeholder="Team ID" value="{{ old('teamId') ? old('teamId') : '' }}">
            @if ($errors->has('teamId'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('teamId') }}
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Add Team</button>
    </form>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="page-title">{{ $team->name }}</h2>
        <table class="table mt-2">
            <tbody>
                @forelse($team->players as $player)
                    <tr>
                        <td>{{ $player->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>There are no players for this team yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users') }}">Gebruikers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admins') }}">Admins</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('teams') }}">Teams</a>
                        </li>
                        |
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('players') }}">Spelers</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

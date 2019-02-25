@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">

                <ul class="nav nav-pills">
                    <li class="nav-item dropdown mr-2">
                        <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" aria-disabled="true">Users</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item disabled" href="#" aria-disabled="true">Create</a>
                            <a class="dropdown-item disabled" href="#" aria-disabled="true">Read</a>
                            <a class="dropdown-item disabled" href="#" aria-disabled="true">Update</a>
                            <a class="dropdown-item disabled" href="#" aria-disabled="true">Delete</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown mr-2">
                        <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" aria-disabled="true">Teams</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item disabled" href="#" aria-disabled="true">Create</a>
                            <a class="dropdown-item disabled" href="#" aria-disabled="true">Read</a>
                            <a class="dropdown-item disabled" href="#" aria-disabled="true">Update</a>
                            <a class="dropdown-item disabled" href="#" aria-disabled="true">Delete</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Players</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item disabled" href="#" aria-disabled="true">Create</a>
                            <a class="dropdown-item" href="{{ route('players') }}">Read</a>
                            <a class="dropdown-item disabled" href="#" aria-disabled="true">Update</a>
                            <a class="dropdown-item disabled" href="#" aria-disabled="true">Delete</a>
                        </div>
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.users.store') }}">
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
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') ? old('email') : '' }}">
            @if ($errors->has('email'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="account_type">Account Type</label>
            <select class="form-control" name="account_type">
                <option value="" selected>Choose account type</option>
                @foreach( App\User::getEnumValues('account_type') as $type)
                    @if (old('account_type') == $type)
                        <option selected value="{{ $type }}">{{ ucwords(str_replace('_', ' ', $type),' ') }}</option>
                    @else
                        <option value="{{ $type }}">{{ ucwords(str_replace('_', ' ', $type),' ') }}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('account_type'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('account_type') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="password" value="">
            @if ($errors->has('password'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="password-confirm">Confirm password</label>
            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Wachtwoord">
            @if ($errors->has('password_confirmation'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>
@endsection
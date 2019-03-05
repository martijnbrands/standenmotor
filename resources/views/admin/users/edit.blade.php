@extends('layouts.admin')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name ? $user->name : '' }}">
            @if ($errors->has('name'))
                <div class="alert alert-danger py-1 mt-1" role="alert">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email ? $user->email : '' }}">
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
                    @elseif ($user->account_type == ucwords(str_replace('_', ' ', $type),' '))
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

        <button type="submit" class="btn btn-primary">Save User</button>
    </form>
</div>
@endsection
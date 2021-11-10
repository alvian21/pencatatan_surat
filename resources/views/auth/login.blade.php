@extends('auth.main')
@section('title')
Login
@endsection
@section('content')
<div id="loginform">
    <div class="logo">
        <span class="db"><img src="{{asset('assets/images/logos/logo-icon.png')}}" alt="logo" /></span>
        <h5 class="font-medium mb-3 mt-3">SMK PENERBANGAN</h5>
        <h5 class="font-medium mb-3">Sign In to Admin</h5>
    </div>
    <!-- Form -->
    <div class="row">
        <div class="col-12">
            <form class="form-horizontal mt-3" method="POST" id="loginform" action="{{route('login')}}">
                @include('auth.alert')
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-lg" placeholder="Username" name="username" aria-label="Username"
                        aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                    </div>
                    <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" aria-label="Password"
                        aria-describedby="basic-addon1">
                </div>

                <div class="form-group text-center">
                    <div class="col-xs-12 pb-3">
                        <button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

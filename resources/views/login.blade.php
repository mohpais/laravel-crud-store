@extends('template')

<style>
    .form-group {
        position: relative;
    }
    .icon-forms {
        position: absolute;
        right: 8px;
        bottom: 11px;
        font-size: 1.2rem
    }
</style>

@section('content')
    <div class="row justify-content-center py-5">
        <div class="col-sm-12 col-md-3 mt-5 mb-4">
            <div class="card">
                <form action="{{ route('login-access') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row my-3">
                            <div class="col-sm-12 text-center">
                                <div class="h5 text-muted">Sign In</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                                    <i class='bx bxs-user icon-forms'></i>
                                    @if ($errors->has('username'))
                                        <span class="text-danger mt-2">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <i class='bx bxs-lock-alt icon-forms'></i>
                                    @if ($errors->has('password'))
                                        <span class="text-danger mt-2">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block">Log In</button>
                            </div>
                        </div>
                        @if (Session::has('success'))
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12">
            <p class="text-center">Belum punya akun? <a href="{{ route('register') }}">Register</a> sekarang!</p>
        </div>
    </div>
@endsection
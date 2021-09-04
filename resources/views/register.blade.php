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
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row my-3">
                            <div class="col-sm-12 text-center">
                                <div class="h5 text-muted">Register</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for=""><strong>Nama Lengkap</strong></label>
                                    <input type="text" name="fullname" class="form-control" placeholder="Nama Lengkap">
                                    @if ($errors->has('fullname'))
                                        <span class="text-danger mt-2">{{ $errors->first('fullname') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for=""><strong>Username</strong></label>
                                    <input type="text" name="username" class="form-control" placeholder="Username">
                                    @if ($errors->has('username'))
                                        <span class="text-danger mt-2">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for=""><strong>Password</strong></label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger mt-2">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for=""><strong>Konfirmasi Password</strong></label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger mt-2">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
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
                </div>
            </form>
        </div>
        <div class="col-sm-12">
            <p class="text-center">Sudah punya akun? <a href="{{ route('login') }}">Login</a> sekarang!</p>
        </div>
    </div>
@endsection
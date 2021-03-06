@extends('layouts.authentication')

@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Login</h3>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login.custom') }}">
                                @csrf

                                @if($errors->has('invalid_data'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('invalid_data') }}
                                    </div>
                                @endif

                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Username" id="username" class="form-control"
                                           name="username" required
                                           autofocus>
                                    @if ($errors->has('username'))
                                        <span class="text-danger">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control"
                                           name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>


                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Sign in</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

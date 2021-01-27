@extends('layouts.auth')


@section('content')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">{{ config('app.name') }}</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}" novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <label class="small mb-1" for="email">Email</label>
                                        <input class="form-control py-4 @error('email') is-invalid @enderror" id="email"
                                            type="email" name="email" value="admin@estore.test" placeholder="Enter email address"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus />

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="small mb-1" for="password">Password</label>
                                        <input class="form-control py-4  @error('password') is-invalid @enderror"
                                            id="password" type="password" placeholder="Enter password" name="password"
                                            required autocomplete="current-password" value="password"/>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        {{-- <a class="small" href="password.html"> --}}
                                            {{-- Forgot Password?
                                        </a> --}}
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>
                                    </div>

                                </form>
                            </div>
                            <div class="card-footer text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="text-center">
                    test
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection

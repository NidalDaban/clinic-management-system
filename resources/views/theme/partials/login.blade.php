@extends('theme.master')
@section('register-active', 'active')
@section('title', 'Welcome Back!')
@section('subtitle')
    <p>Log in to access your appointments, sessions,<br>and personalized care with RafiqCare.</p>
@endsection

@section('content')
    <div class="container mt-5" style="margin-bottom: 2rem">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg rounded">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Welcome Back</h3>

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" required>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <a href="/forgot-password" class="small text-decoration-none">Forgot password?</a>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <small>Don't have an account? <a href="{{ route('register') }}">Register</a></small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

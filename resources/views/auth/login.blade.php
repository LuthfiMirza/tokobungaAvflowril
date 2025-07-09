@extends('layouts.app')

@section('title', 'Login - Avflowril')

@section('content')
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h1 class="breadcrumb-title">Login</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

<!-- Login Area Start -->
<div class="login-area py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="login-form-wrapper">
                    <div class="login-form-header text-center mb-4">
                        <h2 class="form-title">Masuk ke Akun Anda</h2>
                        <p class="form-subtitle">Silakan masuk untuk melanjutkan berbelanja</p>
                    </div>

                    <!-- Display Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Display Error Messages -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="login-form">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="Masukkan email Anda"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Masukkan password Anda"
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Ingat saya
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <button type="submit" class="btn btn-primary w-100 login-btn">
                                <i class="fa fa-sign-in-alt me-2"></i>Masuk
                            </button>
                        </div>

                        <div class="form-footer text-center">
                            <p class="mb-0">
                                Belum punya akun? 
                                <a href="{{ route('register') }}" class="register-link">Daftar di sini</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Area End -->

@push('styles')
<style>
.login-area {
    background-color: #f8f9fa;
    min-height: 70vh;
}

.login-form-wrapper {
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.form-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 10px;
}

.form-subtitle {
    color: #7f8c8d;
    margin-bottom: 0;
}

.form-control {
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #e74c3c;
    box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
}

.login-btn {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    border: none;
    padding: 12px 20px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.login-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
}

.register-link {
    color: #e74c3c;
    text-decoration: none;
    font-weight: 600;
}

.register-link:hover {
    color: #c0392b;
    text-decoration: underline;
}

.breadcrumb-area {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.breadcrumb-title {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 15px;
}

.breadcrumb a {
    color: #e74c3c;
    text-decoration: none;
}

.breadcrumb a:hover {
    color: #c0392b;
}

.alert {
    border-radius: 8px;
    border: none;
}

.form-check-input:checked {
    background-color: #e74c3c;
    border-color: #e74c3c;
}
</style>
@endpush
@endsection
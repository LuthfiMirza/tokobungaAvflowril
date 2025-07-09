@extends('layouts.app')

@section('title', 'Daftar - Avflowril')

@section('content')
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h1 class="breadcrumb-title">Daftar Akun</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

<!-- Register Area Start -->
<div class="register-area py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="register-form-wrapper">
                    <div class="register-form-header text-center mb-4">
                        <h2 class="form-title">Buat Akun Baru</h2>
                        <p class="form-subtitle">Bergabunglah dengan kami untuk pengalaman berbelanja yang lebih baik</p>
                    </div>

                    <!-- Display Error Messages -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST" class="register-form">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Nama Lengkap *</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Masukkan nama lengkap Anda"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Address *</label>
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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password *</label>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Minimal 6 karakter"
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password *</label>
                                    <input type="password" 
                                           class="form-control" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="Ulangi password Anda"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="text" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   placeholder="Contoh: 08123456789">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="3" 
                                      placeholder="Masukkan alamat lengkap Anda">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <button type="submit" class="btn btn-primary w-100 register-btn">
                                <i class="fa fa-user-plus me-2"></i>Daftar Sekarang
                            </button>
                        </div>

                        <div class="form-footer text-center">
                            <p class="mb-0">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" class="login-link">Masuk di sini</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Area End -->

@push('styles')
<style>
.register-area {
    background-color: #f8f9fa;
    min-height: 70vh;
}

.register-form-wrapper {
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

.register-btn {
    background: linear-gradient(135deg, #27ae60, #229954);
    border: none;
    padding: 12px 20px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.register-btn:hover {
    background: linear-gradient(135deg, #229954, #1e8449);
    transform: translateY(-2px);
}

.login-link {
    color: #e74c3c;
    text-decoration: none;
    font-weight: 600;
}

.login-link:hover {
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

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}
</style>
@endpush
@endsection
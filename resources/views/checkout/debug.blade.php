@extends('layouts.app')

@section('title', 'Debug Checkout - Avflowril')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2>Debug Checkout</h2>
            
            <!-- Debug Info -->
            <div class="alert alert-info">
                <h5>Debug Information:</h5>
                <p><strong>User:</strong> {{ Auth::check() ? Auth::user()->name : 'Not logged in' }}</p>
                <p><strong>Cart Items:</strong> {{ count(Session::get('cart', [])) }}</p>
                <p><strong>Cart Content:</strong></p>
                <pre>{{ json_encode(Session::get('cart', []), JSON_PRETTY_PRINT) }}</pre>
            </div>

            <!-- Simple Test Form -->
            <div class="card">
                <div class="card-header">
                    <h5>Test Checkout Form</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.process') }}" method="POST" id="testForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap *</label>
                                <input type="text" class="form-control" name="shipping_name" value="Test User" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nomor Telepon *</label>
                                <input type="tel" class="form-control" name="shipping_phone" value="081234567890" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label>Alamat Lengkap *</label>
                            <textarea class="form-control" name="shipping_address" required>Jl. Test No. 123</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Kota *</label>
                                <select class="form-control" name="shipping_city" required>
                                    <option value="">Pilih Kota</option>
                                    <option value="jakarta" selected>Jakarta</option>
                                    <option value="bogor">Bogor</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Kode Pos *</label>
                                <input type="text" class="form-control" name="shipping_postal_code" value="12345" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label>Metode Pembayaran *</label>
                            <div>
                                <input type="radio" name="payment_method" value="bank_transfer" id="bank" checked required>
                                <label for="bank">Transfer Bank</label>
                            </div>
                            <div>
                                <input type="radio" name="payment_method" value="cod" id="cod" required>
                                <label for="cod">COD</label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label>Catatan (opsional)</label>
                            <textarea class="form-control" name="notes">Test order</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Test Submit</button>
                    </form>
                </div>
            </div>
            
            <!-- Error Display -->
            @if($errors->any())
                <div class="alert alert-danger mt-3">
                    <h5>Validation Errors:</h5>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger mt-3">
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success mt-3">
                    <strong>Success:</strong> {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#testForm').submit(function(e) {
        console.log('Form submitted');
        
        // Show loading
        $('button[type="submit"]').prop('disabled', true).text('Processing...');
        
        // Let form submit normally
        return true;
    });
});
</script>
@endsection
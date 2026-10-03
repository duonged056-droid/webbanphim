@extends('layouts.app')

@section('styles')
<style>
    .auth-container {
        max-width: 450px;
        margin: 5rem auto;
        padding: 3rem 2.5rem;
        background: var(--dark-elevated);
        border: 1px solid var(--border);
        border-radius: 16px;
        box-shadow: var(--shadow-lg);
    }
    .auth-title {
        text-align: center;
        margin-bottom: 2rem;
        font-size: 2rem;
        color: var(--primary);
    }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label { display: block; margin-bottom: 0.5rem; color: var(--gray); font-size: 0.9rem;}
    .form-control { width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); transition: border-color 0.2s; font-family: inherit;}
    .form-control:focus { outline: none; border-color: var(--primary); }
    
    .alert-error { padding: 1rem; background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem;}
</style>
@endsection

@section('content')
<div class="auth-container">
    <h1 class="auth-title">Đăng Ký Tài Khoản</h1>
    
    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
                <div>❌ {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Họ và tên</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
        </div>
        
        <div class="form-group">
            <label>Email đăng nhập</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        
        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        
        <button type="submit" class="btn" style="width: 100%; margin-top: 1rem; padding: 0.8rem; font-size: 1.1rem;">Đăng Ký</button>
    </form>
    
    <div style="text-align: center; margin-top: 2rem; color: var(--gray); font-size: 0.9rem;">
        Đã có tài khoản? <a href="{{ route('login') }}" style="color: var(--primary);">Đăng nhập ngay</a>
    </div>
</div>
@endsection

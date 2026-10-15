@extends('layouts.app')

@section('title', 'Đăng Ký Tài Khoản - KEYLABS')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <div class="rounded-3xl bg-dark-800/90 border border-white/10 p-8 shadow-2xl relative overflow-hidden">
        <!-- Ánh sáng nền -->
        <div class="absolute -top-12 -right-12 w-48 h-48 bg-cyan-500/20 rounded-full blur-2xl pointer-events-none"></div>

        <div class="text-center mb-8 relative z-10">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-brand-500 to-cyan-500 flex items-center justify-center mx-auto mb-3 shadow-lg shadow-brand-500/30">
                <i class="fa-solid fa-user-plus text-white text-lg"></i>
            </div>
            <h1 class="text-2xl font-extrabold text-white">Đăng Ký Tài Khoản</h1>
            <p class="text-xs text-gray-400 mt-1">Trở thành thành viên của KEYLABS ngay hôm nay</p>
        </div>
        
        @if($errors->any())
            <div class="p-3.5 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs mb-6 space-y-1">
                @foreach($errors->all() as $error)
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ $error }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4 relative z-10">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1.5">Họ và tên</label>
                <div class="relative">
                    <input type="text" name="name" class="form-control pl-10" value="{{ old('name') }}" placeholder="Hoàng Văn Đương" required autofocus>
                    <i class="fa-regular fa-user absolute left-3.5 top-3.5 text-gray-400 text-sm pointer-events-none"></i>
                </div>
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1.5">Email đăng nhập</label>
                <div class="relative">
                    <input type="email" name="email" class="form-control pl-10" value="{{ old('email') }}" placeholder="yourname@gmail.com" required>
                    <i class="fa-regular fa-envelope absolute left-3.5 top-3.5 text-gray-400 text-sm pointer-events-none"></i>
                </div>
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1.5">Mật khẩu</label>
                <div class="relative">
                    <input type="password" name="password" class="form-control pl-10" placeholder="Tối thiểu 6 ký tự" required>
                    <i class="fa-solid fa-key absolute left-3.5 top-3.5 text-gray-400 text-sm pointer-events-none"></i>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1.5">Xác nhận mật khẩu</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" class="form-control pl-10" placeholder="Nhập lại mật khẩu" required>
                    <i class="fa-solid fa-shield-halved absolute left-3.5 top-3.5 text-gray-400 text-sm pointer-events-none"></i>
                </div>
            </div>
            
            <button type="submit" class="w-full py-3.5 rounded-2xl bg-brand-500 hover:bg-brand-400 text-white font-bold text-sm shadow-lg shadow-brand-500/30 transition-all flex items-center justify-center gap-2 mt-2">
                <span>Tạo Tài Khoản</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </button>
        </form>
        
        <div class="text-center mt-6 pt-6 border-t border-white/10 text-xs text-gray-400">
            Đã có tài khoản? <a href="{{ route('login') }}" class="text-brand-400 hover:underline font-semibold">Đăng nhập ngay</a>
        </div>
    </div>
</div>
@endsection

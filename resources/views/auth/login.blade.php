@extends('layouts.app')

@section('title', 'Đăng Nhập - KEYLABS')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <div class="rounded-3xl bg-dark-800/90 border border-white/10 p-8 shadow-2xl relative overflow-hidden">
        <!-- Ánh sáng nền -->
        <div class="absolute -top-12 -right-12 w-48 h-48 bg-brand-500/20 rounded-full blur-2xl pointer-events-none"></div>

        <div class="text-center mb-8 relative z-10">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-brand-500 to-cyan-500 flex items-center justify-center mx-auto mb-3 shadow-lg shadow-brand-500/30">
                <i class="fa-solid fa-lock text-white text-lg"></i>
            </div>
            <h1 class="text-2xl font-extrabold text-white">Đăng Nhập</h1>
            <p class="text-xs text-gray-400 mt-1">Chào mừng bạn quay trở lại với KEYLABS</p>
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

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4 relative z-10">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1.5">Email tài khoản</label>
                <div class="relative">
                    <input type="email" name="email" class="form-control pl-10" value="{{ old('email') }}" placeholder="duong@gmail.com" required autofocus>
                    <i class="fa-regular fa-envelope absolute left-3.5 top-3.5 text-gray-400 text-sm pointer-events-none"></i>
                </div>
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1.5">Mật khẩu</label>
                <div class="relative">
                    <input type="password" name="password" class="form-control pl-10" placeholder="••••••" required>
                    <i class="fa-solid fa-key absolute left-3.5 top-3.5 text-gray-400 text-sm pointer-events-none"></i>
                </div>
            </div>
            
            <button type="submit" class="w-full py-3.5 rounded-2xl bg-brand-500 hover:bg-brand-400 text-white font-bold text-sm shadow-lg shadow-brand-500/30 transition-all flex items-center justify-center gap-2 mt-2">
                <span>Đăng Nhập</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </button>
        </form>
        
        <div class="text-center mt-6 pt-6 border-t border-white/10 text-xs text-gray-400">
            Chưa có tài khoản? <a href="{{ route('register') }}" class="text-brand-400 hover:underline font-semibold">Đăng ký ngay</a>
            
            <div class="mt-4 p-3 rounded-xl bg-dark-900/80 border border-white/5 text-left text-[11px] font-mono space-y-1 text-gray-400">
                <div class="text-gray-300 font-bold mb-1">🔑 Tài khoản dùng thử có sẵn:</div>
                <div>• Admin: <span class="text-amber-400">duong@gmail.com</span> / pass: <span class="text-amber-400">1</span></div>
                <div>• Khách: <span class="text-cyan-400">khach@gmail.com</span> / pass: <span class="text-cyan-400">123456</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

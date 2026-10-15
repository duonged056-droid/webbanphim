@extends('layouts.app')

@section('title', ($sanpham->TenSP ?? 'Chi tiết sản phẩm') . ' - KEYLABS')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-gray-400 mb-8 font-medium">
        <a href="{{ route('home') }}" class="hover:text-brand-400 transition-colors">Trang chủ</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <a href="{{ route('home', ['category' => $sanpham->LoaiSP]) }}#products" class="hover:text-brand-400 transition-colors">{{ $sanpham->LoaiSP }}</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <span class="text-white truncate max-w-[250px] sm:max-w-none">{{ $sanpham->TenSP }}</span>
    </nav>

    @php
        $hinh = $sanpham->HinhAnh;
        $imgUrl = Str::startsWith($hinh, ['http://', 'https://']) 
                    ? $hinh 
                    : (Str::startsWith($hinh, 'images/') ? asset($hinh) : asset('images/' . $hinh));
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 bg-dark-800/80 rounded-3xl border border-white/10 p-6 sm:p-10">
        
        <!-- Cột Ảnh (5 cột) -->
        <div class="lg:col-span-5 flex flex-col gap-4">
            <div class="relative bg-dark-900 rounded-2xl border border-white/10 p-6 flex items-center justify-center overflow-hidden aspect-square group">
                <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-dark-800/90 border border-white/10 text-xs font-mono text-brand-400 font-semibold uppercase">
                    {{ $sanpham->LoaiSP }}
                </span>
                
                <img src="{{ $imgUrl }}" 
                     alt="{{ $sanpham->TenSP }}" 
                     onerror="this.src='{{ asset('images/kb_1.jpg') }}'"
                     class="w-full h-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-500 shadow-2xl">
            </div>

            <!-- Cam kết nhanh -->
            <div class="grid grid-cols-2 gap-3 pt-2">
                <div class="p-3 rounded-xl bg-white/5 border border-white/5 flex items-center gap-3 text-xs text-gray-300">
                    <i class="fa-solid fa-shield-halved text-brand-400 text-base"></i>
                    <span>Bảo hành chính hãng 12T</span>
                </div>
                <div class="p-3 rounded-xl bg-white/5 border border-white/5 flex items-center gap-3 text-xs text-gray-300">
                    <i class="fa-solid fa-truck-fast text-cyan-400 text-base"></i>
                    <span>Freeship toàn quốc</span>
                </div>
            </div>
        </div>

        <!-- Cột Thông tin (7 cột) -->
        <div class="lg:col-span-7 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="px-2.5 py-0.5 rounded-md text-xs font-mono {{ $sanpham->SoLuongTon > 0 ? 'bg-emerald-500/10 border border-emerald-500/30 text-emerald-400' : 'bg-rose-500/10 border border-rose-500/30 text-rose-400' }}">
                        {{ $sanpham->SoLuongTon > 0 ? '✓ Còn ' . $sanpham->SoLuongTon . ' sản phẩm' : '✕ Tạm hết hàng' }}
                    </span>
                    <span class="text-xs text-gray-400 font-mono">Mã SP: #{{ $sanpham->MaSP }}</span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight mb-4">
                    {{ $sanpham->TenSP }}
                </h1>

                <!-- Giá -->
                <div class="p-4 rounded-2xl bg-dark-900/80 border border-white/10 mb-6 flex items-baseline gap-3">
                    <span class="text-3xl sm:text-4xl font-extrabold font-mono text-transparent bg-clip-text bg-gradient-to-r from-brand-400 via-white to-cyan-400">
                        {{ number_format($sanpham->GiaBan, 0, ',', '.') }}₫
                    </span>
                    <span class="text-xs text-gray-400">Đã bao gồm VAT</span>
                </div>

                <!-- Mô tả -->
                <div class="mb-8">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-300 mb-2">Mô tả sản phẩm</h3>
                    <p class="text-sm text-gray-400 leading-relaxed bg-white/5 p-4 rounded-2xl border border-white/5">
                        {{ $sanpham->MoTa ?: 'Sản phẩm chính hãng KEYLABS với chất lượng hoàn thiện cao cấp, đã được mod stab và cân wire sẵn sàng sử dụng.' }}
                    </p>
                </div>
            </div>

            <!-- Nút mua hàng / thêm giỏ -->
            <div class="pt-6 border-t border-white/10">
                @if(Auth::check())
                    <form action="{{ route('cart.add', $sanpham->MaSP) }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                        @csrf
                        <div class="flex items-center bg-dark-900 border border-white/10 rounded-2xl p-1 w-36">
                            <button type="button" onclick="const q = document.getElementById('qty'); if (q.value > 1) q.value--;" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-white transition-colors">
                                <i class="fa-solid fa-minus text-xs"></i>
                            </button>
                            <input type="number" id="qty" name="quantity" value="1" min="1" max="{{ $sanpham->SoLuongTon }}" 
                                   class="w-full text-center bg-transparent border-none text-white font-mono font-bold focus:outline-none">
                            <button type="button" onclick="const q = document.getElementById('qty'); if (q.value < {{ $sanpham->SoLuongTon }}) q.value++;" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-white transition-colors">
                                <i class="fa-solid fa-plus text-xs"></i>
                            </button>
                        </div>

                        <button type="submit" {{ $sanpham->SoLuongTon == 0 ? 'disabled' : '' }}
                                class="flex-1 py-3.5 px-6 rounded-2xl bg-brand-500 hover:bg-brand-400 disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold text-sm shadow-lg shadow-brand-500/25 transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-cart-plus text-base"></i> Thêm vào giỏ hàng
                        </button>
                    </form>
                @else
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <a href="{{ route('login') }}" class="w-full sm:flex-1 py-3.5 px-6 rounded-2xl bg-brand-500 hover:bg-brand-400 text-white font-bold text-sm text-center shadow-lg shadow-brand-500/25 transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> Đăng nhập để mua hàng
                        </a>
                        <a href="{{ route('register') }}" class="w-full sm:w-auto py-3.5 px-6 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/10 text-gray-300 hover:text-white font-semibold text-sm text-center transition-all">
                            Đăng ký tài khoản
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection

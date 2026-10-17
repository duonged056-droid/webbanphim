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

                <h1 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight mb-2">
                    {{ $sanpham->TenSP }}
                </h1>

                <!-- Đánh giá sao -->
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex items-center text-amber-400 text-sm gap-0.5">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star {{ $i <= round($sanpham->diem_trung_binh) ? 'text-amber-400' : 'text-gray-600' }}"></i>
                        @endfor
                    </div>
                    <span class="text-sm font-bold text-white">{{ number_format($sanpham->diem_trung_binh, 1) }} / 5</span>
                    <span class="text-xs text-gray-400">({{ $sanpham->tong_danh_gia }} đánh giá từ khách mua)</span>
                </div>

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

    <!-- KHU VỰC ĐÁNH GIÁ CỦA KHÁCH HÀNG -->
    <div class="mt-12 bg-dark-800/80 rounded-3xl border border-white/10 p-6 sm:p-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-8 border-b border-white/10">
            <div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fa-solid fa-comments text-brand-400"></i> Đánh giá từ khách hàng
                </h2>
                <p class="text-xs text-gray-400 mt-1">Trải nghiệm thực tế từ những người đã sở hữu sản phẩm</p>
            </div>

            <!-- Tổng quan điểm số -->
            <div class="flex items-center gap-4 bg-dark-900/60 border border-white/10 rounded-2xl px-5 py-3.5">
                <div class="text-center">
                    <span class="text-3xl font-black text-amber-400 leading-none">{{ number_format($sanpham->diem_trung_binh, 1) }}</span>
                    <span class="text-xs text-gray-500 block">trên 5.0</span>
                </div>
                <div class="h-8 w-px bg-white/10"></div>
                <div>
                    <div class="flex text-amber-400 text-xs gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star {{ $i <= round($sanpham->diem_trung_binh) ? 'text-amber-400' : 'text-gray-600' }}"></i>
                        @endfor
                    </div>
                    <span class="text-xs text-gray-400 mt-0.5 block">{{ $danhGias->count() }} lượt nhận xét</span>
                </div>
            </div>
        </div>

        <!-- Danh sách đánh giá -->
        <div class="mt-8 space-y-6">
            @forelse($danhGias as $dg)
                <div class="p-5 rounded-2xl bg-white/[0.03] border border-white/5 hover:border-white/10 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center font-bold text-white text-sm">
                                {{ substr($dg->user->name ?? 'K', 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white">{{ $dg->user->name ?? 'Khách hàng' }}</h4>
                                <span class="text-[11px] text-gray-500">{{ $dg->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-1 text-amber-400 text-xs">
                            @for($s = 1; $s <= 5; $s++)
                                <i class="fa-solid fa-star {{ $s <= $dg->so_sao ? 'text-amber-400' : 'text-gray-700' }}"></i>
                            @endfor
                        </div>
                    </div>

                    @if($dg->tieu_de)
                        <h5 class="text-sm font-semibold text-gray-200 mb-1.5">{{ $dg->tieu_de }}</h5>
                    @endif
                    <p class="text-xs sm:text-sm text-gray-400 leading-relaxed">{{ $dg->noi_dung }}</p>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500">
                    <i class="fa-regular fa-comment-dots text-4xl mb-2 block"></i>
                    <p class="text-sm">Chưa có đánh giá nào cho sản phẩm này. Hãy là người đầu tiên trải nghiệm!</p>
                </div>
            @endforelse
        </div>

        <!-- Biểu mẫu gửi đánh giá mới -->
        <div class="mt-10 pt-8 border-t border-white/10">
            @auth
                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-pen text-indigo-400 text-sm"></i> Viết đánh giá của bạn
                </h3>
                <form action="{{ route('san-pham.danh-gia', $sanpham->MaSP) }}" method="POST" class="space-y-4 max-w-2xl">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Đánh giá số sao *</label>
                        <div class="flex items-center gap-3">
                            <select name="so_sao" class="form-control w-44" required>
                                <option value="5">★★★★★ (5 sao - Tuyệt vời)</option>
                                <option value="4">★★★★☆ (4 sao - Rất tốt)</option>
                                <option value="3">★★★☆☆ (3 sao - Bình thường)</option>
                                <option value="2">★★☆☆☆ (2 sao - Tạm được)</option>
                                <option value="1">★☆☆☆☆ (1 sao - Không ưng ý)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Tiêu đề nhận xét</label>
                        <input type="text" name="tieu_de" placeholder="Vd: Cảm giác gõ rất đã, chất lượng tốt" class="form-control">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Nội dung chi tiết *</label>
                        <textarea name="noi_dung" rows="3" required placeholder="Chia sẻ cảm nhận về switch, keycap, độ hoàn thiện, âm thanh phím..." class="form-control"></textarea>
                    </div>

                    <button type="submit" class="py-2.5 px-6 rounded-xl bg-brand-500 hover:bg-brand-400 text-white font-bold text-sm shadow-lg shadow-brand-500/25 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-paper-plane text-xs"></i> Gửi Đánh Giá
                    </button>
                </form>
            @else
                <div class="p-6 rounded-2xl bg-white/[0.02] border border-white/5 text-center">
                    <p class="text-sm text-gray-400 mb-3">Vui lòng đăng nhập để có thể để lại đánh giá cho sản phẩm này.</p>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-brand-500 hover:bg-brand-400 text-white text-xs font-bold transition-all">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Đăng nhập ngay
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection

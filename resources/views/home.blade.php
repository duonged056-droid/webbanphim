@extends('layouts.app')

@section('title', 'KEYLABS - Trang Chủ Bàn Phím Cơ Thế Hệ Mới')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">

    <!-- 1. HERO BENTO GRID (Xu hướng thiết kế 2026) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-14">
        
        <!-- Banner chính (8 cột) -->
        <div class="lg:col-span-8 relative rounded-3xl overflow-hidden bg-gradient-to-br from-indigo-950 via-dark-800 to-dark-900 border border-white/10 p-8 sm:p-12 flex flex-col justify-between min-h-[420px] group">
            <!-- Ánh sáng nền trang trí -->
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 right-8 w-72 h-72 bg-cyan-500/15 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-500/15 border border-brand-500/30 text-brand-400 text-xs font-mono mb-6">
                    <span class="w-2 h-2 rounded-full bg-brand-400 animate-pulse"></span>
                    NEW ARRIVAL 2026 • GASKET MOUNT
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-[1.15]">
                    Đỉnh Cao Âm Gõ <br>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 via-cyan-400 to-purple-400">
                        Chuẩn "Thocky"
                    </span>
                </h1>
                <p class="text-gray-400 text-sm sm:text-base mt-4 leading-relaxed">
                    Khám phá bộ sưu tập bàn phím cơ Custom, mạch xuôi, kết nối 3 Modes không dây độ trễ cực thấp dành cho cả Coder và Gamer chuyên nghiệp.
                </p>
            </div>

            <div class="relative z-10 flex flex-wrap items-center gap-4 mt-8">
                <a href="#products" class="px-6 py-3.5 rounded-2xl bg-brand-500 hover:bg-brand-400 text-white font-bold text-sm shadow-lg shadow-brand-500/30 transition-all flex items-center gap-2">
                    Mua sắm ngay <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="{{ route('build.index') }}" class="px-6 py-3.5 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/15 text-white font-semibold text-sm transition-all flex items-center gap-2">
                    <i class="fa-solid fa-sliders text-cyan-400"></i> Tự Build Phím
                </a>
            </div>

            <!-- Hình bàn phím nổi góc phải -->
            <img src="{{ asset('images/kb_0.jpg') }}" alt="Featured Keyboard" 
                 class="hidden sm:block absolute -right-6 bottom-6 w-80 lg:w-96 rounded-2xl object-cover shadow-2xl border border-white/10 transform -rotate-6 group-hover:rotate-0 group-hover:scale-105 transition-all duration-500 opacity-90">
        </div>

        <!-- 2 Cột Bento phụ bên phải (4 cột) -->
        <div class="lg:col-span-4 flex flex-col gap-6">
            <!-- Box 1: Custom Lab -->
            <div class="flex-1 rounded-3xl bg-dark-800 border border-white/10 p-6 relative overflow-hidden group hover:border-cyan-500/40 transition-all">
                <div class="relative z-10">
                    <span class="text-xs font-mono uppercase text-cyan-400 font-semibold">Custom Studio</span>
                    <h3 class="text-xl font-bold text-white mt-1">Tự Tay Lắp Ráp</h3>
                    <p class="text-xs text-gray-400 mt-1 mb-4 max-w-[200px]">Chọn Kit, Switch và Keycap theo cá tính riêng của bạn.</p>
                    <a href="{{ route('build.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-cyan-400 group-hover:translate-x-1 transition-transform">
                        Bắt đầu ngay <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </a>
                </div>
                <img src="{{ asset('images/keychron.jpg') }}" class="absolute right-0 bottom-0 w-36 h-36 object-cover rounded-tl-2xl opacity-40 group-hover:opacity-70 group-hover:scale-105 transition-all" alt="Keychron">
            </div>

            <!-- Box 2: Thương hiệu nổi bật -->
            <div class="flex-1 rounded-3xl bg-dark-800 border border-white/10 p-6 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-mono uppercase text-gray-400">Đối tác chính hãng</span>
                    <i class="fa-solid fa-shield-halved text-brand-400"></i>
                </div>
                <div class="grid grid-cols-3 gap-3 my-3">
                    <a href="{{ route('home', ['keyword' => 'Keychron']) }}#products" class="bg-dark-900 border border-white/5 hover:border-brand-500/50 rounded-xl p-2 flex flex-col items-center justify-center group transition-all">
                        <img src="{{ asset('images/keychron.jpg') }}" class="w-10 h-10 rounded-lg object-cover mb-1" alt="Keychron">
                        <span class="text-[11px] font-semibold text-gray-300 group-hover:text-white">Keychron</span>
                    </a>
                    <a href="{{ route('home', ['keyword' => 'Akko']) }}#products" class="bg-dark-900 border border-white/5 hover:border-brand-500/50 rounded-xl p-2 flex flex-col items-center justify-center group transition-all">
                        <img src="{{ asset('images/akko.jpg') }}" class="w-10 h-10 rounded-lg object-cover mb-1" alt="Akko">
                        <span class="text-[11px] font-semibold text-gray-300 group-hover:text-white">Akko</span>
                    </a>
                    <a href="{{ route('home', ['keyword' => 'Cherry']) }}#products" class="bg-dark-900 border border-white/5 hover:border-brand-500/50 rounded-xl p-2 flex flex-col items-center justify-center group transition-all">
                        <img src="{{ asset('images/cherry.jpg') }}" class="w-10 h-10 rounded-lg object-cover mb-1" alt="Cherry">
                        <span class="text-[11px] font-semibold text-gray-300 group-hover:text-white">Cherry</span>
                    </a>
                </div>
                <div class="text-[11px] text-gray-400 flex items-center justify-between border-t border-white/5 pt-2">
                    <span>✓ Bảo hành 1 đổi 1</span>
                    <span>✓ Hỗ trợ trả góp 0%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. THANH LỌC NHANH (FILTER PILLS & SEARCH) -->
    <div id="products" class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-white/10">
        <div>
            <h2 class="text-2xl font-extrabold text-white flex items-center gap-2.5">
                <span class="w-2 h-6 rounded-full bg-brand-500"></span>
                Danh Mục Sản Phẩm
            </h2>
            <p class="text-xs text-gray-400 mt-1">Bàn phím cơ, Switch custom và Keycaps cao cấp có sẵn tại cửa hàng</p>
        </div>

        <!-- Bộ lọc Danh Mục & Sắp xếp -->
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('home') }}#products" class="px-4 py-2 rounded-xl text-xs font-semibold transition-all {{ !request('category') && !request('keyword') ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/25' : 'bg-dark-800 text-gray-400 hover:text-white border border-white/10' }}">
                Tất cả
            </a>
            @if(isset($categories))
                @foreach($categories as $cat)
                    <a href="{{ route('home', ['category' => $cat]) }}#products" class="px-4 py-2 rounded-xl text-xs font-semibold transition-all {{ request('category') == $cat ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/25' : 'bg-dark-800 text-gray-400 hover:text-white border border-white/10' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            @endif

            <!-- Dropdown sắp xếp giá -->
            <form action="{{ route('home') }}#products" method="GET" class="inline-block ml-auto sm:ml-2">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('keyword'))
                    <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                @endif
                <select name="sort" onchange="this.form.submit()" class="bg-dark-800 border border-white/10 text-gray-300 text-xs rounded-xl px-3 py-2 focus:outline-none focus:border-brand-500 cursor-pointer">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá: Thấp đến cao</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá: Cao đến thấp</option>
                </select>
            </form>
        </div>
    </div>

    <!-- 3. LƯỚI SẢN PHẨM (PRODUCT CARDS HIỆN ĐẠI) -->
    @php
        $listSanPham = $sanphams ?? $sanPhams ?? collect();
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
        @forelse($listSanPham as $sp)
            @php
                $id = $sp->MaSP ?? $sp->id ?? 1;
                $ten = $sp->TenSP ?? $sp->ten_san_pham ?? 'Bàn phím cơ Custom';
                $gia = $sp->GiaBan ?? $sp->gia ?? 1590000;
                $hinh = $sp->HinhAnh ?? $sp->hinh_anh ?? 'kb_1.jpg';
                $loai = $sp->LoaiSP ?? 'Bàn phím cơ';
                $stock = $sp->SoLuongTon ?? 10;
                
                // Xử lý link ảnh
                $imgUrl = Str::startsWith($hinh, ['http://', 'https://']) 
                            ? $hinh 
                            : (Str::startsWith($hinh, 'images/') ? asset($hinh) : asset('images/' . $hinh));
            @endphp

            <div class="group bg-dark-800/90 rounded-3xl border border-white/10 hover:border-brand-500/50 overflow-hidden transition-all duration-300 flex flex-col justify-between card-glow">
                
                <div>
                    <!-- Khung ảnh + Badges -->
                    <div class="relative h-56 bg-dark-900 overflow-hidden p-4 flex items-center justify-center">
                        <!-- Badge Phân loại -->
                        <span class="absolute top-3 left-3 z-10 px-2.5 py-1 rounded-lg bg-dark-900/80 backdrop-blur-md border border-white/10 text-[10px] font-mono uppercase text-brand-400 font-semibold">
                            {{ $loai }}
                        </span>

                        <!-- Badge Tình trạng kho -->
                        <span class="absolute top-3 right-3 z-10 px-2 py-0.5 rounded-md text-[10px] font-mono {{ $stock > 0 ? 'bg-cyan-500/10 border border-cyan-500/30 text-cyan-400' : 'bg-rose-500/10 border border-rose-500/30 text-rose-400' }}">
                            {{ $stock > 0 ? 'Còn hàng' : 'Tạm hết' }}
                        </span>

                        <a href="{{ route('detail', $id) }}" class="w-full h-full flex items-center justify-center">
                            <img src="{{ $imgUrl }}" alt="{{ $ten }}" 
                                 onerror="this.src='{{ asset('images/kb_1.jpg') }}'"
                                 class="w-full h-full object-cover rounded-2xl group-hover:scale-110 transition-transform duration-500">
                        </a>
                    </div>

                    <!-- Thông tin sản phẩm -->
                    <div class="p-5">
                        <!-- Tech Specs Pills -->
                        <div class="flex items-center gap-1.5 mb-2.5">
                            <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 text-gray-400">Hot-swap</span>
                            <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 text-gray-400">RGB</span>
                            <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 text-gray-400">PBT</span>
                        </div>

                        <a href="{{ route('detail', $id) }}">
                            <h3 class="text-base font-bold text-white group-hover:text-brand-400 transition-colors line-clamp-2 min-h-[48px]">
                                {{ $ten }}
                            </h3>
                        </a>
                    </div>
                </div>

                <!-- Giá & Nút Thêm Giỏ Hàng -->
                <div class="px-5 pb-5 pt-2 border-t border-white/5 flex items-center justify-between">
                    <div>
                        <span class="block text-[10px] text-gray-500 uppercase font-mono">Giá ưu đãi</span>
                        <span class="text-lg font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-300 font-mono">
                            {{ number_format($gia, 0, ',', '.') }}₫
                        </span>
                    </div>

                    <form action="{{ route('cart.add', $id) }}" method="POST">
                        @csrf
                        <button type="submit" title="Thêm vào giỏ hàng"
                                class="w-11 h-11 rounded-2xl bg-brand-500/15 hover:bg-brand-500 border border-brand-500/30 text-brand-400 hover:text-white flex items-center justify-center transition-all shadow-lg hover:shadow-brand-500/30">
                            <i class="fa-solid fa-cart-plus"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 bg-dark-800/50 rounded-3xl border border-white/10">
                <i class="fa-regular fa-keyboard text-4xl text-gray-500 mb-3"></i>
                <p class="text-gray-400">Chưa tìm thấy sản phẩm phù hợp.</p>
            </div>
        @endforelse
    </div>

    <!-- Phân trang -->
    @if(method_exists($listSanPham, 'links'))
        <div class="mt-10 flex justify-center">
            {{ $listSanPham->links() }}
        </div>
    @endif

    <!-- 4. KHU VỰC THỬ ÂM SWITCH (SOUND TEST LAB) -->
    <div class="mt-20 rounded-3xl bg-gradient-to-r from-dark-800 via-indigo-950/40 to-dark-800 border border-white/10 p-8 sm:p-12 relative overflow-hidden">
        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-2xl mb-8">
            <span class="text-xs font-mono uppercase text-brand-400 font-semibold tracking-wider">Trải nghiệm âm thanh</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
                Lựa Chọn <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-cyan-400">Chất Âm & Cảm Giác Gõ</span>
            </h2>
            <p class="text-gray-400 text-sm mt-2">
                Nghe thử và cảm nhận đặc tính của từng loại switch trước khi quyết định xuống tiền.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Switch 1: Linear -->
            <div class="bg-dark-900/90 border border-white/10 hover:border-rose-500/40 rounded-2xl p-5 transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <span class="w-10 h-10 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center text-lg font-bold">
                        <i class="fa-solid fa-feather-pointed"></i>
                    </span>
                    <span class="text-[11px] font-mono px-2 py-0.5 rounded bg-rose-500/10 text-rose-300">Creamy / Mượt mà</span>
                </div>
                <h3 class="text-lg font-bold text-white group-hover:text-rose-400 transition-colors">Linear (Red / Silver)</h3>
                <p class="text-xs text-gray-400 mt-1 mb-4">Lực nhấn nhẹ 45g, hành trình trơn tru không khấc cản, phù hợp gõ lướt và combat gaming tốc độ cao.</p>
                <div class="flex items-center justify-between pt-3 border-t border-white/5">
                    <span class="text-xs text-gray-400 font-mono">Độ ồn: Thấp • Êm</span>
                    <button type="button" onclick="playSwitchSound('linear')" class="text-xs font-semibold text-rose-400 hover:text-white flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-rose-500/10 hover:bg-rose-500 transition-all">
                        <i class="fa-solid fa-volume-high"></i> Thử âm
                    </button>
                </div>
            </div>

            <!-- Switch 2: Tactile -->
            <div class="bg-dark-900/90 border border-white/10 hover:border-amber-500/40 rounded-2xl p-5 transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <span class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-lg font-bold">
                        <i class="fa-solid fa-hand-fist"></i>
                    </span>
                    <span class="text-[11px] font-mono px-2 py-0.5 rounded bg-amber-500/10 text-amber-300">Thocky / Có Khấc</span>
                </div>
                <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors">Tactile (Brown / Holy Panda)</h3>
                <p class="text-xs text-gray-400 mt-1 mb-4">Phản hồi xúc giác rõ ràng tại điểm nhận phím, âm trầm đầm tay (Thocky), sinh ra cho dân Coder & Content.</p>
                <div class="flex items-center justify-between pt-3 border-t border-white/5">
                    <span class="text-xs text-gray-400 font-mono">Độ ồn: Vừa phải</span>
                    <button type="button" onclick="playSwitchSound('tactile')" class="text-xs font-semibold text-amber-400 hover:text-white flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-500/10 hover:bg-amber-500 transition-all">
                        <i class="fa-solid fa-volume-high"></i> Thử âm
                    </button>
                </div>
            </div>

            <!-- Switch 3: Clicky -->
            <div class="bg-dark-900/90 border border-white/10 hover:border-cyan-500/40 rounded-2xl p-5 transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <span class="w-10 h-10 rounded-xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-lg font-bold">
                        <i class="fa-solid fa-bolt"></i>
                    </span>
                    <span class="text-[11px] font-mono px-2 py-0.5 rounded bg-cyan-500/10 text-cyan-300">Clacky / Đanh giòn</span>
                </div>
                <h3 class="text-lg font-bold text-white group-hover:text-cyan-400 transition-colors">Clicky (Blue / Jade)</h3>
                <p class="text-xs text-gray-400 mt-1 mb-4">Tiếng tách giòn tan đặc trưng cùng khấc nảy rõ rệt, mang lại sự phấn khích tột độ trên từng nhịp gõ.</p>
                <div class="flex items-center justify-between pt-3 border-t border-white/5">
                    <span class="text-xs text-gray-400 font-mono">Độ ồn: Cao • Phấn khích</span>
                    <button type="button" onclick="playSwitchSound('clicky')" class="text-xs font-semibold text-cyan-400 hover:text-white flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-cyan-500/10 hover:bg-cyan-500 transition-all">
                        <i class="fa-solid fa-volume-high"></i> Thử âm
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. HƯỚNG DẪN BUILD PHÍM 3 BƯỚC -->
    <div class="mt-20 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 rounded-3xl bg-brand-500/10 border border-brand-500/20 p-8 flex flex-col justify-between">
            <div>
                <span class="text-xs font-mono uppercase text-brand-400 font-semibold">Quy trình chuyên nghiệp</span>
                <h3 class="text-2xl font-extrabold text-white mt-2 leading-tight">
                    Build Chiếc Phím Mang Dấu Ấn Của Bạn
                </h3>
                <p class="text-gray-400 text-sm mt-3 leading-relaxed">
                    Đội ngũ Kỹ thuật viên KEYLABS sẽ cân chỉnh wire, lube switch thủ công bằng mỡ Krytox 205g0 & Permatex tỉ mỉ trước khi đóng gói.
                </p>
            </div>
            <a href="{{ route('build.index') }}" class="mt-6 inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-brand-500 hover:bg-brand-400 text-white font-bold text-sm shadow-lg shadow-brand-500/30 transition-all">
                Mở Studio Build Phím <i class="fa-solid fa-sliders"></i>
            </a>
        </div>

        <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- Step 1 -->
            <div class="bg-dark-800/80 border border-white/10 rounded-2xl p-6 flex flex-col justify-between">
                <div>
                    <span class="text-2xl font-mono font-black text-brand-400/40">01</span>
                    <h4 class="text-base font-bold text-white mt-2">Chọn Kit & Layout</h4>
                    <p class="text-xs text-gray-400 mt-2">Nhôm CNC hay Nhựa ABS, mạch xuôi, kết nối Type-C/2.4G/Bluetooth cùng layout 65%, 75%, TKL.</p>
                </div>
                <div class="mt-4 pt-3 border-t border-white/5 text-[11px] text-gray-500 font-mono">Gasket Mount • Foam Poron</div>
            </div>

            <!-- Step 2 -->
            <div class="bg-dark-800/80 border border-white/10 rounded-2xl p-6 flex flex-col justify-between">
                <div>
                    <span class="text-2xl font-mono font-black text-brand-400/40">02</span>
                    <h4 class="text-base font-bold text-white mt-2">Chọn Switch & Lube</h4>
                    <p class="text-xs text-gray-400 mt-2">Tuyển chọn các dòng switch cao cấp: Gateron Oil King, KTT Kang White, Akko V3 Piano Pro.</p>
                </div>
                <div class="mt-4 pt-3 border-t border-white/5 text-[11px] text-gray-500 font-mono">Lube Full 205g0 + Film</div>
            </div>

            <!-- Step 3 -->
            <div class="bg-dark-800/80 border border-white/10 rounded-2xl p-6 flex flex-col justify-between">
                <div>
                    <span class="text-2xl font-mono font-black text-brand-400/40">03</span>
                    <h4 class="text-base font-bold text-white mt-2">Chọn Set Keycap</h4>
                    <p class="text-xs text-gray-400 mt-2">Chất liệu nhựa PBT Doubleshot chống bóng, Profile Cherry, OEM, MOA với hàng trăm tone màu.</p>
                </div>
                <div class="mt-4 pt-3 border-t border-white/5 text-[11px] text-gray-500 font-mono">PBT Doubleshot • Dyesub</div>
            </div>
        </div>
    </div>

    <!-- 6. CAM KẾT DỊCH VỤ -->
    <div class="mt-20 py-12 border-y border-white/10 grid grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-brand-500/10 border border-brand-500/20 flex items-center justify-center text-brand-400 text-xl shrink-0">
                <i class="fa-solid fa-truck-fast"></i>
            </div>
            <div>
                <h4 class="text-sm font-bold text-white">Giao Hỏa Tốc 2H</h4>
                <p class="text-xs text-gray-400 mt-0.5">Nội thành HN & TP.HCM</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 text-xl shrink-0">
                <i class="fa-solid fa-wrench"></i>
            </div>
            <div>
                <h4 class="text-sm font-bold text-white">Mod Sẵn Tiêu Chuẩn</h4>
                <p class="text-xs text-gray-400 mt-0.5">Cân wire & tape mod free</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 text-xl shrink-0">
                <i class="fa-solid fa-shield-check"></i>
            </div>
            <div>
                <h4 class="text-sm font-bold text-white">Bảo Hành 12 Tháng</h4>
                <p class="text-xs text-gray-400 mt-0.5">Lỗi 1 đổi 1 trong 30 ngày</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 text-xl shrink-0">
                <i class="fa-solid fa-credit-card"></i>
            </div>
            <div>
                <h4 class="text-sm font-bold text-white">Trả Góp 0% Lãi Suất</h4>
                <p class="text-xs text-gray-400 mt-0.5">Duyệt nhanh qua thẻ tín dụng</p>
            </div>
        </div>
    </div>

    <!-- 7. GÓC FEEDBACK TỪ CỘNG ĐỒNG -->
    <div class="mt-20">
        <div class="text-center max-w-xl mx-auto mb-10">
            <span class="text-xs font-mono uppercase text-cyan-400 font-semibold tracking-wider">Cộng Đồng KEYLABS</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">Góc Setup Của Khách Hàng</h2>
            <p class="text-gray-400 text-sm mt-2">Hơn 10.000+ tín đồ cơ học đã tin tưởng chọn KEYLABS để hoàn thiện góc làm việc mơ ước.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Review 1 -->
            <div class="bg-dark-800/80 border border-white/10 rounded-2xl p-6 flex flex-col justify-between">
                <p class="text-gray-300 text-sm italic leading-relaxed">
                    "Shop mod stab quá đỉnh, phím space gõ chắc nịch không một tiếng lọc xọc. Switch Oil King lube sẵn mượt như lụa. Đóng gói 3 lớp xốp rất an tâm."
                </p>
                <div class="flex items-center gap-3 mt-6 pt-4 border-t border-white/5">
                    <div class="w-10 h-10 rounded-full bg-brand-500/20 border border-brand-500/40 flex items-center justify-center text-brand-400 font-bold text-sm">
                        H
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white">Hoàng Nam (Senior FE Dev)</h4>
                        <div class="flex text-amber-400 text-xs mt-0.5">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 2 -->
            <div class="bg-dark-800/80 border border-white/10 rounded-2xl p-6 flex flex-col justify-between">
                <p class="text-gray-300 text-sm italic leading-relaxed">
                    "Giao hỏa tốc đúng 1 tiếng 30 phút là có phím trên tay. Tự build phím qua tool web trực quan dễ hiểu, nhân viên còn gọi xác nhận màu keycap cực có tâm."
                </p>
                <div class="flex items-center gap-3 mt-6 pt-4 border-t border-white/5">
                    <div class="w-10 h-10 rounded-full bg-cyan-500/20 border border-cyan-500/40 flex items-center justify-center text-cyan-400 font-bold text-sm">
                        Q
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white">Quang Minh (Audio Engineer)</h4>
                        <div class="flex text-amber-400 text-xs mt-0.5">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 3 -->
            <div class="bg-dark-800/80 border border-white/10 rounded-2xl p-6 flex flex-col justify-between">
                <p class="text-gray-300 text-sm italic leading-relaxed">
                    "Kit phím nhôm cầm đầm tay, âm thock gõ văn phòng vừa êm vừa không phiền đồng nghiệp. Chắc chắn sẽ còn quay lại sắm thêm switch để trải nghiệm."
                </p>
                <div class="flex items-center gap-3 mt-6 pt-4 border-t border-white/5">
                    <div class="w-10 h-10 rounded-full bg-purple-500/20 border border-purple-500/40 flex items-center justify-center text-purple-400 font-bold text-sm">
                        T
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white">Thùy Trang (UI/UX Designer)</h4>
                        <div class="flex text-amber-400 text-xs mt-0.5">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- SCRIPT GIẢ LẬP ÂM THANH SWITCH -->
@push('scripts')
<script>
    let homeAudioCtx = null;
    function playSwitchSound(type) {
        try {
            if (!homeAudioCtx) {
                homeAudioCtx = new (window.AudioContext || window.webkitAudioContext)();
            }
            if (homeAudioCtx.state === 'suspended') {
                homeAudioCtx.resume();
            }
            const osc = homeAudioCtx.createOscillator();
            const gain = homeAudioCtx.createGain();
            
            osc.connect(gain);
            gain.connect(homeAudioCtx.destination);

            const now = homeAudioCtx.currentTime;

            if (type === 'linear') {
                osc.type = 'triangle';
                osc.frequency.setValueAtTime(140, now);
                osc.frequency.exponentialRampToValueAtTime(45, now + 0.08);
                gain.gain.setValueAtTime(0.5, now);
                gain.gain.exponentialRampToValueAtTime(0.001, now + 0.08);
                osc.start(now);
                osc.stop(now + 0.08);
            } else if (type === 'tactile') {
                osc.type = 'sine';
                osc.frequency.setValueAtTime(220, now);
                osc.frequency.exponentialRampToValueAtTime(60, now + 0.1);
                gain.gain.setValueAtTime(0.6, now);
                gain.gain.exponentialRampToValueAtTime(0.001, now + 0.1);
                osc.start(now);
                osc.stop(now + 0.1);
            } else if (type === 'clicky') {
                osc.type = 'square';
                osc.frequency.setValueAtTime(1200, now);
                osc.frequency.exponentialRampToValueAtTime(200, now + 0.04);
                gain.gain.setValueAtTime(0.3, now);
                gain.gain.exponentialRampToValueAtTime(0.001, now + 0.04);
                osc.start(now);
                osc.stop(now + 0.04);
            }
        } catch (e) {
            console.log("Audio error: ", e);
        }
    }
</script>
@endpush
@endsection
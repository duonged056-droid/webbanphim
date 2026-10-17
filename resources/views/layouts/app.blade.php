<!DOCTYPE html>
<html lang="vi" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KEYLABS - Thế Giới Bàn Phím Cơ & Custom Gear')</title>

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    colors: {
                        dark: {
                            900: '#090D16',
                            800: '#111827',
                            700: '#1F2937',
                        },
                        brand: {
                            500: '#6366F1', // Indigo
                            400: '#818CF8',
                            accent: '#06B6D4' // Cyan Neon
                        }
                    }
                }
            }
        }
    </script>
    <!-- Ẩn cảnh báo Tailwind CDN chỉ ở môi trường dev local -->
    <script>
        (function() {
            const _warn = console.warn.bind(console);
            console.warn = function(...args) {
                if (args[0] && typeof args[0] === 'string' && args[0].includes('cdn.tailwindcss.com')) return;
                _warn(...args);
            };
        })();
    </script>

    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --secondary: #a855f7;
            --accent: #06b6d4;
            --dark: #090d16;
            --dark-elevated: #111827;
            --darker: #050811;
            --light: #f8fafc;
            --gray: #94a3b8;
            --border: rgba(255, 255, 255, 0.1);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #090D16; }
        ::-webkit-scrollbar-thumb { background: #1F2937; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #6366F1; }

        .glass-nav {
            background: rgba(9, 13, 22, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .card-glow:hover {
            box-shadow: 0 0 25px -5px rgba(99, 102, 241, 0.35), 0 0 10px -5px rgba(6, 182, 212, 0.2);
        }

        .btn {
            background: #6366f1;
            color: #ffffff !important;
            padding: 0.65rem 1.4rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
        }
        .btn:hover {
            background: #4f46e5;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
        }
        .btn-danger {
            background: #ef4444 !important;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25) !important;
        }
        .btn-danger:hover {
            background: #dc2626 !important;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: #0d1322;
            color: #f8fafc;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }
        .form-control:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.25);
        }
    </style>
    @yield('styles')
    @stack('styles')
</head>
<body class="bg-dark-900 text-gray-100 font-sans antialiased selection:bg-brand-500 selection:text-white flex flex-col min-h-screen">

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-cyan-500 text-white text-xs font-medium py-2 px-4 text-center">
        <span>⚡ <strong>ƯU ĐÃI THÁNG 10:</strong> Giảm ngay 15% khi Custom Full Kit + Tặng kèm Switch Puller cao cấp!</span>
    </div>

    <!-- Header / Glassmorphism Navbar -->
    <header class="sticky top-0 z-50 glass-nav border-b border-white/10 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-accent flex items-center justify-center shadow-lg shadow-brand-500/30 group-hover:rotate-6 transition-transform">
                        <i class="fa-regular fa-keyboard text-white text-xl"></i>
                    </div>
                    <div>
                        <span class="text-xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white via-gray-200 to-brand-400">
                            KEY<span class="text-brand-400">LABS</span>
                        </span>
                        <span class="block text-[10px] font-mono text-gray-400 tracking-widest uppercase">Mechanical Art</span>
                    </div>
                </a>

                <!-- Navigation Links (Desktop) -->
                <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold">
                    <a href="{{ route('home') }}" class="text-white hover:text-brand-400 transition-colors flex items-center gap-1.5">
                        <i class="fa-solid fa-house text-xs text-brand-400"></i> Trang chủ
                    </a>
                    <a href="{{ route('home') }}#products" class="text-gray-300 hover:text-white transition-colors">
                        Bàn phím cơ
                    </a>
                    <a href="{{ route('build.index') }}" class="relative px-3.5 py-1.5 rounded-full bg-white/5 border border-brand-500/40 text-brand-400 hover:bg-brand-500 hover:text-white transition-all flex items-center gap-2 shadow-sm shadow-brand-500/20">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> Custom Phím
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500"></span>
                        </span>
                    </a>
                    <a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-colors">
                        Liên hệ
                    </a>
                </nav>

                <!-- Search, Cart, Auth & Mobile Menu Button -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <!-- Thanh tìm kiếm nhanh -->
                    <form action="{{ route('home') }}#products" method="GET" class="hidden lg:flex items-center bg-dark-800/90 border border-white/10 rounded-full px-4 py-2 focus-within:border-brand-500 transition-colors">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 text-sm"></i>
                        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Tìm Keychron, Akko, Switch..." 
                               class="bg-transparent border-none text-sm text-white placeholder-gray-500 focus:outline-none ml-2.5 w-48">
                    </form>

                    <!-- Giỏ hàng -->
                    @php
                        $cartCount = session('cart') ? count(session('cart')) : 0;
                    @endphp
                    <a href="{{ route('cart.index') }}" class="relative p-2.5 rounded-xl bg-dark-800 border border-white/10 hover:border-brand-500/50 text-gray-200 hover:text-white transition-all" title="Giỏ hàng">
                        <i class="fa-solid fa-bag-shopping text-lg"></i>
                        @if($cartCount > 0)
                            <span class="absolute -top-1.5 -right-1.5 bg-gradient-to-r from-brand-500 to-cyan-500 text-white text-[11px] font-bold font-mono w-5 h-5 rounded-full flex items-center justify-center shadow-lg">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Tài khoản -->
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2.5 py-1.5 px-3 rounded-xl bg-dark-800 border border-white/10 hover:border-white/20 transition-all">
                                <div class="w-7 h-7 rounded-lg bg-brand-500/20 border border-brand-500/40 flex items-center justify-center text-brand-400 font-bold text-xs">
                                    {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                                </div>
                                <span class="text-sm font-medium hidden sm:block">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-[10px] text-gray-400"></i>
                            </button>
                            <!-- Dropdown -->
                            <div class="absolute right-0 mt-2 w-48 rounded-2xl bg-dark-800 border border-white/10 shadow-2xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-amber-400 hover:bg-white/5">
                                        <i class="fa-solid fa-gauge-high"></i> Quản trị viên
                                    </a>
                                @endif
                                <a href="{{ route('orders.index') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5">
                                    <i class="fa-solid fa-box-open"></i> Đơn hàng của tôi
                                </a>
                                <a href="{{ route('ho-so.index') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/5">
                                    <i class="fa-solid fa-user-circle"></i> Hồ sơ cá nhân
                                </a>
                                <hr class="border-white/10 my-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-rose-400 hover:bg-rose-500/10 text-left">
                                        <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl bg-brand-500 hover:bg-brand-400 text-white text-sm font-semibold shadow-lg shadow-brand-500/25 transition-all">
                            Đăng nhập
                        </a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button type="button" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="md:hidden p-2 rounded-xl bg-dark-800 border border-white/10 text-gray-300 hover:text-white focus:outline-none">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Nav Dropdown -->
            <div id="mobileMenu" class="hidden md:hidden py-4 border-t border-white/10 space-y-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-white hover:bg-white/5">Trang chủ</a>
                <a href="{{ route('home') }}#products" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:bg-white/5">Bàn phím cơ</a>
                <a href="{{ route('build.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-brand-400 hover:bg-white/5">Custom Phím</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:bg-white/5">Liên hệ</a>
                @auth
                    <div class="pt-2 border-t border-white/10 space-y-1">
                        <a href="{{ route('orders.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:bg-white/5">
                            <i class="fa-solid fa-box-open mr-2 text-brand-400"></i>Đơn hàng của tôi
                        </a>
                        <a href="{{ route('ho-so.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:bg-white/5">
                            <i class="fa-solid fa-user-circle mr-2 text-cyan-400"></i>Hồ sơ cá nhân
                        </a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-amber-400 hover:bg-white/5">
                                <i class="fa-solid fa-gauge-high mr-2"></i>Trang Quản trị
                            </a>
                        @endif
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Thông báo Flash Message -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm">
                <i class="fa-solid fa-circle-check text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="flex items-center gap-3 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-sm">
                <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Modern Footer -->
    <footer class="bg-dark-800/60 border-t border-white/10 mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Cột 1: Thông tin thương hiệu & Mạng xã hội -->
                <div class="col-span-1 md:col-span-1">
                    <span class="text-xl font-extrabold text-white">KEY<span class="text-brand-400">LABS</span></span>
                    <p class="text-gray-400 text-sm mt-3 leading-relaxed">
                        Chuyên cung cấp bàn phím cơ Custom, Keychron, Akko, Cherry chính hãng. Nâng tầm trải nghiệm gõ phím mỗi ngày.
                    </p>
                    <div class="flex items-center gap-3 mt-4">
                        <a href="#" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-brand-500 text-gray-400 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-brand-500 text-gray-400 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-discord text-sm"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-brand-500 text-gray-400 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-youtube text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Cột 2: Danh mục -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Danh mục</h4>
                    <ul class="space-y-2.5 text-sm text-gray-400">
                        <li><a href="{{ route('home', ['category' => 'Bàn phím cơ']) }}#products" class="hover:text-brand-400 transition-colors">Bàn phím cơ</a></li>
                        <li><a href="{{ route('home', ['category' => 'Switch']) }}#products" class="hover:text-brand-400 transition-colors">Switch phím cơ</a></li>
                        <li><a href="{{ route('home', ['category' => 'Keycap']) }}#products" class="hover:text-brand-400 transition-colors">Keycap Sets</a></li>
                        <li><a href="{{ route('build.index') }}" class="hover:text-brand-400 transition-colors">Custom Keyboard Kit</a></li>
                    </ul>
                </div>

                <!-- Cột 3: Hỗ trợ khách hàng -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Hỗ trợ khách hàng</h4>
                    <ul class="space-y-2.5 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-brand-400 transition-colors">Chính sách bảo hành 12 tháng</a></li>
                        <li><a href="#" class="hover:text-brand-400 transition-colors">Hướng dẫn Lube Switch & Mod</a></li>
                        <li><a href="{{ route('orders.index') }}" class="hover:text-brand-400 transition-colors">Tra cứu đơn hàng</a></li>
                    </ul>
                </div>

                <!-- Cột 4: Đăng ký nhận tin -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Đăng ký nhận tin</h4>
                    <p class="text-xs text-gray-400 mb-3">Nhận thông báo Group Buy & Flash Sale sớm nhất.</p>
                    <form action="#" method="POST" class="flex gap-2">
                        @csrf
                        <input type="email" placeholder="Email của bạn..." required 
                               class="bg-dark-900 border border-white/10 rounded-xl px-3 py-2 text-sm text-white w-full focus:outline-none focus:border-brand-500 transition-colors">
                        <button type="submit" class="px-4 py-2 bg-brand-500 hover:bg-brand-400 text-white rounded-xl text-sm font-medium transition-colors whitespace-nowrap">
                            Gửi
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom Copyright bar -->
            <div class="mt-12 pt-6 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-500 gap-4">
                <p>&copy; {{ date('Y') }} KEYLABS. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-gray-400 transition-colors">Điều khoản dịch vụ</a>
                    <a href="#" class="hover:text-gray-400 transition-colors">Chính sách bảo mật</a>
                </div>
            </div>
        </div>
    </footer>

    @yield('scripts')
    @stack('scripts')
</body>
</html>
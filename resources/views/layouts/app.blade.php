<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Đương phím cơ - Chuyên cung cấp bàn phím cơ, switch, keycap và phụ kiện custom cao cấp chính hãng.">
    <meta name="keywords" content="bàn phím cơ, mechanical keyboard, switch, keycap, custom keyboard, Đương phím cơ">
    <meta name="author" content="Đương phím cơ">
    <title>Đương phím cơ - Bàn phím cơ cao cấp</title>
    
    <!-- Preload fonts cho tốc độ load nhanh hơn (SEO optimization) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* Design System Tokens */
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --secondary: #a855f7;
            --accent: #fbbf24;
            --dark: #0f172a;
            --dark-elevated: #1e293b;
            --darker: #020617;
            --light: #f8fafc;
            --gray: #94a3b8;
            --border: #334155;
            --glass: rgba(15, 23, 42, 0.75);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.5);
        }
        
        [data-theme="light"] {
            --dark: #ffffff;
            --dark-elevated: #f8fafc;
            --darker: #f1f5f9;
            --light: #0f172a;
            --gray: #475569;
            --border: #cbd5e1;
            --glass: rgba(255, 255, 255, 0.85);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--darker);
            color: var(--light);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4 { font-family: 'Outfit', sans-serif; }
        a { text-decoration: none; color: inherit; }

        input, textarea, select {
            background-color: var(--dark-elevated);
            color: var(--light);
            border: 1px solid var(--border);
            padding: 0.5rem;
            border-radius: 6px;
            font-family: inherit;
            color-scheme: dark light;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
        }

        /* Navbar Glassmorphism */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background: var(--glass);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            z-index: 1000;
            border-bottom: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }

        .nav-links { display: flex; gap: 2.5rem; }
        .nav-links a {
            font-weight: 500;
            color: var(--light);
            transition: color 0.2s ease, text-shadow 0.2s ease;
        }
        .nav-links a:hover {
            color: var(--primary);
            text-shadow: 0 0 10px rgba(99, 102, 241, 0.4);
        }

        .btn {
            background: var(--primary);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            display: inline-block;
            text-align: center;
        }
        .btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
        }

        main {
            margin-top: 85px;
            min-height: calc(100vh - 170px);
        }

        footer {
            background: var(--dark-elevated);
            padding: 3rem 2rem;
            text-align: center;
            border-top: 1px solid var(--border);
            margin-top: 5rem;
            color: var(--gray);
        }
    </style>
    @yield('styles')
</head>
<body>

    <nav>
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">ĐƯƠNG PHÍM CƠ</a>
            <div class="nav-links">
                <a href="{{ route('home') }}">Trang chủ</a>
                <a href="{{ route('home') }}#products">Sản phẩm</a>
                <a href="{{ route('build.index') }}" style="color: var(--accent); font-weight: bold; background: rgba(251, 191, 36, 0.1); padding: 0 0.8rem; border-radius: 8px;">🛠️ Build Phím</a>
                <a href="{{ route('contact') }}">Liên hệ</a>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('admin.sanpham.index') }}" style="color: var(--accent);">Admin Panel</a>
                @endif
            </div>
            <div style="display: flex; gap: 1rem; align-items: center;">
                @if(Auth::check())
                    <span style="color: var(--gray); font-size: 0.9rem; margin-right: 0.5rem;">👋 {{ Auth::user()->name }}</span>
                    <a href="{{ route('orders.index') }}" style="color: var(--light); text-decoration: none; font-size: 0.9rem; margin-right: 0.5rem; padding-right: 1rem; border-right: 1px solid var(--border);">Đơn hàng của tôi</a>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn" style="background: var(--gray); padding: 0.5rem 1rem;">Đăng xuất</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn" style="background: var(--gray); padding: 0.5rem 1rem;">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn" style="padding: 0.5rem 1rem;">Đăng ký</a>
                @endif
                <a href="{{ Auth::check() ? route('cart.index') : route('login') }}" class="btn" style="padding: 0.5rem 1rem;">
                    Giỏ hàng ({{ session()->has('cart') ? count(session('cart')) : 0 }})
                </a>
                <button id="theme-toggle" class="btn" style="background: transparent; color: var(--light); padding: 0.5rem; font-size: 1.2rem; box-shadow: none;" title="Đổi màu Nền Sáng/Tối">🌓</button>
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div style="max-width: 1200px; margin: 0 auto 2rem auto; padding: 1rem 1.5rem; background: rgba(16, 185, 129, 0.1); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 8px; font-weight: 500;">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="max-width: 1200px; margin: 0 auto 2rem auto; padding: 1rem 1.5rem; background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 8px; font-weight: 500;">
                ❌ {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>

    <footer>
        <h3 style="color: var(--light); margin-bottom: 1rem;">ĐƯƠNG PHÍM CƠ</h3>
        <p>&copy; 2026 Đương phím cơ. Mang lại trải nghiệm gõ phím hoàn hảo nhất.</p>
    </footer>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme) {
            document.documentElement.setAttribute('data-theme', currentTheme);
        }
        themeToggle.addEventListener('click', () => {
            let theme = document.documentElement.getAttribute('data-theme');
            if (theme === 'light') {
                document.documentElement.removeAttribute('data-theme');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            }
        });
    </script>
</body>
</html>

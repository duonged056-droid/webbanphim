<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị - Đương phím cơ Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --bg-dark: #0f172a;
            --bg-panel: #1e293b;
            --text-light: #f8fafc;
            --text-gray: #94a3b8;
            --border: #334155;
        }
        body { margin: 0; font-family: 'Inter', sans-serif; background: var(--bg-dark); color: var(--text-light); display: flex; }
        .sidebar { width: 250px; background: var(--bg-panel); min-height: 100vh; padding: 2rem 1rem; border-right: 1px solid var(--border); }
        .sidebar a { display: block; padding: 1rem; color: var(--text-light); text-decoration: none; margin-bottom: 0.5rem; border-radius: 8px; transition: background 0.2s; }
        .sidebar a:hover, .sidebar a.active { background: var(--primary); }
        .content { flex: 1; padding: 2rem; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border); }
        .btn { background: var(--primary); color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; text-decoration: none; font-weight: 500; }
        table { width: 100%; border-collapse: collapse; background: var(--bg-panel); border-radius: 8px; overflow: hidden; }
        th, td { padding: 1rem; text-align: left; border-bottom: 1px solid var(--border); }
        th { background: rgba(0,0,0,0.2); font-weight: 600; color: var(--text-gray); }
        tr:hover { background: rgba(255,255,255,0.02); }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: var(--bg-panel); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border); }
        .stat-card h3 { margin: 0 0 0.5rem 0; color: var(--text-gray); font-size: 0.9rem; font-weight: 500; }
        .stat-card .value { font-size: 2rem; font-weight: 700; color: var(--primary); margin: 0; }
        
        input, textarea, select {
            background-color: var(--bg-panel);
            color: var(--text-light);
            border: 1px solid var(--border);
            padding: 0.5rem;
            border-radius: 6px;
            font-family: inherit;
            color-scheme: dark;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 style="margin-bottom: 2rem; padding-left: 1rem; color: var(--primary);">Đương phím cơ Admin</h2>
        <a href="{{ route('admin.dashboard') }}">Bảng Điều Khiển</a>
        <a href="{{ route('admin.sanpham.index') }}">Sản Phẩm</a>
        <a href="{{ route('admin.orders.index') }}">Đơn Hàng</a>
        <a href="{{ route('admin.khach-hang.index') }}">Khách Hàng</a>
        <a href="{{ route('home') }}" style="margin-top: 2rem; color: var(--text-gray);">← Về trang chủ</a>
    </div>
    <div class="content">
        <div class="header">
            <h1>@yield('title', 'Admin Panel')</h1>
            <div style="display: flex; gap: 1rem;">
                <span style="align-self: center;">Xin chào, {{ Auth::user()->name }}</span>
            </div>
        </div>
        
        @if(session('success'))
            <div style="background: #059669; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>

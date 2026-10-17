@extends('admin.layout')

@section('title', 'Quản Lý Khách Hàng')

@section('content')

{{-- Search & Filter Bar --}}
<form method="GET" action="{{ route('admin.khach-hang.index') }}" style="display:flex;gap:1rem;margin-bottom:1.5rem;flex-wrap:wrap;align-items:center;">
    <input type="text" name="search" value="{{ request('search') }}"
        placeholder="Tìm tên, email, SĐT..."
        style="flex:1;min-width:220px;padding:0.6rem 1rem;border-radius:8px;border:1px solid var(--border);background:var(--bg-panel);color:var(--text-light);">

    <select name="trang_thai" style="padding:0.6rem 1rem;border-radius:8px;border:1px solid var(--border);background:var(--bg-panel);color:var(--text-light);">
        <option value="">-- Tất cả trạng thái --</option>
        <option value="active"   {{ request('trang_thai') === 'active'   ? 'selected' : '' }}>Hoạt động</option>
        <option value="inactive" {{ request('trang_thai') === 'inactive' ? 'selected' : '' }}>Đã khoá</option>
    </select>

    <button type="submit" class="btn"><i class="fa fa-search" style="margin-right:6px;"></i>Lọc</button>
    <a href="{{ route('admin.khach-hang.index') }}" class="btn" style="background:#334155;">Reset</a>
</form>

{{-- Stats Row --}}
<div class="stats-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:1.5rem;">
    <div class="stat-card">
        <h3>Tổng khách hàng</h3>
        <p class="value">{{ $users->total() }}</p>
    </div>
    <div class="stat-card">
        <h3>Đang hoạt động</h3>
        <p class="value" style="color:#10b981;">{{ $users->where('is_active', true)->count() }}</p>
    </div>
    <div class="stat-card">
        <h3>Đã khoá</h3>
        <p class="value" style="color:#ef4444;">{{ $users->where('is_active', false)->count() }}</p>
    </div>
</div>

{{-- Table --}}
<div style="overflow-x:auto;">
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Khách hàng</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Ngày đăng ký</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr>
            <td style="font-family:monospace;color:var(--text-gray);font-size:0.8rem;">#{{ $user->id }}</td>
            <td>
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#6366f1,#06b6d4);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.9rem;flex-shrink:0;">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <div style="font-weight:600;">{{ $user->name }}</div>
                        <div style="font-size:0.8rem;color:var(--text-gray);">{{ $user->email }}</div>
                    </div>
                </div>
            </td>
            <td style="color:var(--text-gray);">{{ $user->so_dien_thoai ?: '—' }}</td>
            <td style="color:var(--text-gray);font-size:0.85rem;max-width:200px;">
                {{ collect([$user->dia_chi, $user->quan_huyen, $user->tinh_thanh])->filter()->implode(', ') ?: '—' }}
            </td>
            <td style="color:var(--text-gray);font-size:0.85rem;">{{ $user->created_at->format('d/m/Y') }}</td>
            <td>
                @if($user->is_active)
                    <span style="background:#10b98120;color:#10b981;border:1px solid #10b98140;padding:3px 10px;border-radius:20px;font-size:0.78rem;font-weight:600;">
                        ● Hoạt động
                    </span>
                @else
                    <span style="background:#ef444420;color:#ef4444;border:1px solid #ef444440;padding:3px 10px;border-radius:20px;font-size:0.78rem;font-weight:600;">
                        ● Đã khoá
                    </span>
                @endif
            </td>
            <td>
                <div style="display:flex;gap:6px;">
                    <a href="{{ route('admin.khach-hang.show', $user->id) }}" class="btn" style="padding:0.35rem 0.8rem;font-size:0.8rem;background:#334155;">
                        Chi tiết
                    </a>
                    <form action="{{ route('admin.khach-hang.toggle', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn" style="padding:0.35rem 0.8rem;font-size:0.8rem;background:{{ $user->is_active ? '#ef444430' : '#10b98130' }};color:{{ $user->is_active ? '#ef4444' : '#10b981' }};border:1px solid;">
                            {{ $user->is_active ? 'Khoá' : 'Mở' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.khach-hang.destroy', $user->id) }}" method="POST"
                          onsubmit="return confirm('Xoá khách hàng {{ $user->name }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn" style="padding:0.35rem 0.8rem;font-size:0.8rem;background:#ef444420;color:#ef4444;">
                            Xoá
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;color:var(--text-gray);padding:3rem;">Không tìm thấy khách hàng nào.</td></tr>
        @endforelse
    </tbody>
</table>
</div>

{{-- Pagination --}}
<div style="margin-top:1.5rem;">
    {{ $users->withQueryString()->links() }}
</div>

@endsection


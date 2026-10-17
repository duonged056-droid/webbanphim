@extends('admin.layout')

@section('title', 'Chi Tiết Khách Hàng: ' . $user->name)

@section('content')

<div style="margin-bottom:1.5rem;">
    <a href="{{ route('admin.khach-hang.index') }}" class="btn" style="background:#334155;">
        ← Quay lại danh sách
    </a>
</div>

<div style="display:grid;grid-template-columns:1fr 2fr;gap:1.5rem;">

    {{-- Cột trái: Thông tin cá nhân --}}
    <div>
        {{-- Avatar + Tên --}}
        <div class="stat-card" style="text-align:center;margin-bottom:1rem;">
            <div style="width:72px;height:72px;border-radius:16px;background:linear-gradient(135deg,#6366f1,#06b6d4);display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:800;margin:0 auto 1rem;">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div style="font-size:1.1rem;font-weight:700;">{{ $user->name }}</div>
            <div style="color:var(--text-gray);font-size:0.85rem;margin-top:4px;">{{ $user->email }}</div>
            <div style="margin-top:0.75rem;">
                @if($user->is_active)
                    <span style="background:#10b98120;color:#10b981;border:1px solid #10b98140;padding:4px 12px;border-radius:20px;font-size:0.8rem;font-weight:600;">● Hoạt động</span>
                @else
                    <span style="background:#ef444420;color:#ef4444;border:1px solid #ef444440;padding:4px 12px;border-radius:20px;font-size:0.8rem;font-weight:600;">● Đã khoá</span>
                @endif
            </div>
        </div>

        {{-- Thông tin chi tiết --}}
        <div class="stat-card" style="margin-bottom:1rem;">
            <h3 style="font-size:0.85rem;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:1rem;">Thông tin cá nhân</h3>
            <table style="width:100%;background:transparent;border:none;">
                <tr>
                    <td style="color:var(--text-gray);font-size:0.85rem;padding:5px 0;width:40%;border:none;">Số ĐT:</td>
                    <td style="font-size:0.85rem;padding:5px 0;border:none;">{{ $user->so_dien_thoai ?: '—' }}</td>
                </tr>
                <tr>
                    <td style="color:var(--text-gray);font-size:0.85rem;padding:5px 0;border:none;">Giới tính:</td>
                    <td style="font-size:0.85rem;padding:5px 0;border:none;">{{ $user->gioi_tinh ?: '—' }}</td>
                </tr>
                <tr>
                    <td style="color:var(--text-gray);font-size:0.85rem;padding:5px 0;border:none;">Ngày sinh:</td>
                    <td style="font-size:0.85rem;padding:5px 0;border:none;">{{ $user->ngay_sinh ? $user->ngay_sinh->format('d/m/Y') : '—' }}</td>
                </tr>
                <tr>
                    <td style="color:var(--text-gray);font-size:0.85rem;padding:5px 0;border:none;">Địa chỉ:</td>
                    <td style="font-size:0.85rem;padding:5px 0;border:none;">
                        {{ collect([$user->dia_chi, $user->phuong_xa, $user->quan_huyen, $user->tinh_thanh])->filter()->implode(', ') ?: '—' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:var(--text-gray);font-size:0.85rem;padding:5px 0;border:none;">Đăng ký:</td>
                    <td style="font-size:0.85rem;padding:5px 0;border:none;">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <td style="color:var(--text-gray);font-size:0.85rem;padding:5px 0;border:none;">Đăng nhập cuối:</td>
                    <td style="font-size:0.85rem;padding:5px 0;border:none;">{{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Chưa ghi nhận' }}</td>
                </tr>
            </table>
        </div>

        {{-- Stats --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-bottom:1rem;">
            <div class="stat-card" style="padding:1rem;">
                <h3 style="font-size:0.75rem;">Tổng đơn hàng</h3>
                <p class="value" style="font-size:1.5rem;">{{ $donHangs->count() }}</p>
            </div>
            <div class="stat-card" style="padding:1rem;">
                <h3 style="font-size:0.75rem;">Tổng chi tiêu</h3>
                <p class="value" style="font-size:1.2rem;">{{ number_format($tongChiTieu, 0, ',', '.') }}₫</p>
            </div>
        </div>

        {{-- Khoá / Mở khoá --}}
        <form action="{{ route('admin.khach-hang.toggle', $user->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn" style="width:100%;background:{{ $user->is_active ? '#ef444420' : '#10b98120' }};color:{{ $user->is_active ? '#ef4444' : '#10b981' }};">
                {{ $user->is_active ? '🔒 Khoá tài khoản' : '🔓 Mở khoá tài khoản' }}
            </button>
        </form>
    </div>

    {{-- Cột phải: Đơn hàng + Địa chỉ --}}
    <div>
        {{-- Địa chỉ giao hàng --}}
        <div class="stat-card" style="margin-bottom:1rem;">
            <h3 style="font-size:0.85rem;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:1rem;">
                Địa chỉ giao hàng ({{ $diaChis->count() }})
            </h3>
            @forelse($diaChis as $dc)
            <div style="padding:0.75rem;border-radius:8px;background:rgba(255,255,255,0.03);border:1px solid var(--border);margin-bottom:0.5rem;">
                <div style="display:flex;justify-content:space-between;align-items:start;">
                    <div>
                        <strong>{{ $dc->ho_ten }}</strong>
                        <span style="color:var(--text-gray);font-size:0.85rem;margin-left:8px;">{{ $dc->so_dien_thoai }}</span>
                        @if($dc->la_mac_dinh)
                            <span style="margin-left:6px;background:#6366f120;color:#6366f1;border:1px solid #6366f140;padding:2px 8px;border-radius:12px;font-size:0.72rem;">Mặc định</span>
                        @endif
                        <div style="color:var(--text-gray);font-size:0.82rem;margin-top:3px;">{{ $dc->dia_chi_day_du }}</div>
                    </div>
                </div>
            </div>
            @empty
            <p style="color:var(--text-gray);font-size:0.85rem;">Chưa có địa chỉ nào.</p>
            @endforelse
        </div>

        {{-- Lịch sử đơn hàng --}}
        <div class="stat-card">
            <h3 style="font-size:0.85rem;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:1rem;">
                Lịch sử đơn hàng (10 gần nhất)
            </h3>
            @forelse($donHangs as $dh)
            <div style="display:flex;justify-content:space-between;align-items:center;padding:0.65rem 0;border-bottom:1px solid var(--border);">
                <div>
                    <a href="{{ route('admin.orders.show', $dh->MaHD) }}" style="color:var(--primary);font-weight:600;text-decoration:none;font-size:0.9rem;">
                        #{{ $dh->MaHD }}
                    </a>
                    <span style="color:var(--text-gray);font-size:0.8rem;margin-left:8px;">{{ \Carbon\Carbon::parse($dh->NgayDat)->format('d/m/Y') }}</span>
                </div>
                <div style="text-align:right;">
                    <div style="font-weight:600;font-size:0.9rem;">{{ number_format($dh->TongTien, 0, ',', '.') }}₫</div>
                    <div>
                        @php
                            $color = match($dh->TrangThai) {
                                'Đã hoàn thành' => '#10b981',
                                'Đang xử lý'    => '#f59e0b',
                                'Đã huỷ'        => '#ef4444',
                                default         => '#94a3b8',
                            };
                        @endphp
                        <span style="font-size:0.75rem;color:{{ $color }};">{{ $dh->TrangThai }}</span>
                    </div>
                </div>
            </div>
            @empty
            <p style="color:var(--text-gray);font-size:0.85rem;">Khách hàng chưa có đơn hàng nào.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection


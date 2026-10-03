@extends('admin.layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Tổng quan (Dashboard)</h2>
</div>

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 3rem;">
    <div style="background: linear-gradient(135deg, #3b82f6, #2563eb); padding: 1.5rem; border-radius: 12px; color: white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <h4 style="font-size: 0.9rem; margin-bottom: 0.5rem; opacity: 0.9;">TỔNG DOANH THU</h4>
        <div style="font-size: 2rem; font-weight: bold;">{{ number_format($tongDoanhThu, 0, ',', '.') }} ₫</div>
    </div>
    
    <div style="background: linear-gradient(135deg, #10b981, #059669); padding: 1.5rem; border-radius: 12px; color: white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <h4 style="font-size: 0.9rem; margin-bottom: 0.5rem; opacity: 0.9;">ĐƠN HÀNG HOÀN THÀNH</h4>
        <div style="font-size: 2rem; font-weight: bold;">{{ $tongDonHang - $donChoXuLy }} <span style="font-size: 1rem; font-weight: normal;">/ {{ $tongDonHang }}</span></div>
    </div>
    
    <div style="background: linear-gradient(135deg, #f59e0b, #d97706); padding: 1.5rem; border-radius: 12px; color: white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <h4 style="font-size: 0.9rem; margin-bottom: 0.5rem; opacity: 0.9;">ĐƠN ĐANG CHỜ XỬ LÝ</h4>
        <div style="font-size: 2rem; font-weight: bold;">{{ $donChoXuLy }}</div>
    </div>
    
    <div style="background: linear-gradient(135deg, #8b5cf6, #6d28d9); padding: 1.5rem; border-radius: 12px; color: white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <h4 style="font-size: 0.9rem; margin-bottom: 0.5rem; opacity: 0.9;">TỔNG KHÁCH HÀNG</h4>
        <div style="font-size: 2rem; font-weight: bold;">{{ $tongKhachHang }}</div>
    </div>
</div>

<div style="background: rgba(0,0,0,0.15); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border);">
    <h3 style="color: var(--light); margin-bottom: 1rem;">Đơn hàng mới nhất</h3>
    @if($donMoiNhat->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Mã ĐH</th>
                    <th>Khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donMoiNhat as $order)
                <tr>
                    <td>#{{ $order->MaHD }}</td>
                    <td>{{ $order->TenKhachHang }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->NgayDat)->format('d/m/Y H:i') }}</td>
                    <td style="color: var(--primary); font-weight: bold;">{{ number_format($order->TongTien, 0, ',', '.') }} ₫</td>
                    <td>
                        <span style="padding: 0.3rem 0.6rem; border-radius: 4px; font-size: 0.85rem; {{ $order->TrangThai == 'Đã hoàn thành' ? 'background: rgba(16, 185, 129, 0.2); color: #10b981;' : 'background: rgba(245, 158, 11, 0.2); color: #f59e0b;' }}">
                            {{ $order->TrangThai }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 1.5rem; text-align: right;">
            <a href="{{ route('admin.orders.index') }}" class="btn" style="background: transparent; border: 1px solid var(--primary); color: var(--primary);">Xem tất cả đơn hàng &rarr;</a>
        </div>
    @else
        <p style="color: var(--gray);">Chưa có đơn hàng nào.</p>
    @endif
</div>
@endsection

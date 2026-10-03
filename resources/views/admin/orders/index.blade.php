@extends('admin.layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Quản lý Đơn hàng</h2>
</div>

<table>
    <thead>
        <tr>
            <th>Mã ĐH</th>
            <th>Khách hàng</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>#{{ $order->MaHD }}</td>
            <td>
                <strong>{{ $order->TenKhachHang }}</strong><br>
                <small style="color: var(--gray);">{{ $order->DienThoai }}</small>
            </td>
            <td>{{ \Carbon\Carbon::parse($order->NgayDat)->format('d/m/Y H:i') }}</td>
            <td style="color: var(--primary); font-weight: bold;">{{ number_format($order->TongTien, 0, ',', '.') }} ₫</td>
            <td>
                <span style="padding: 0.3rem 0.6rem; background: rgba(16, 185, 129, 0.2); color: #10b981; border-radius: 4px; font-size: 0.85rem;">
                    {{ $order->TrangThai }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.orders.show', $order->MaHD) }}" class="btn" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Xem chi tiết</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top: 2rem;">
    {{ $orders->links('pagination::bootstrap-4') }}
</div>
@endsection

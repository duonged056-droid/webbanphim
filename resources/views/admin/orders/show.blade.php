@extends('admin.layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Chi tiết Đơn hàng #{{ $order->MaHD }}</h2>
    <div style="display: flex; gap: 1rem;">
        @if($order->TrangThai !== 'Đã hoàn thành')
            <form action="{{ route('admin.orders.complete', $order->MaHD) }}" method="POST">
                @csrf
                <button type="submit" class="btn" style="background: #10b981;" onclick="return confirm('Đánh dấu đơn hàng này là Đã hoàn thành?')">✅ Đánh dấu Hoàn thành</button>
            </form>
        @endif
        <a href="{{ route('admin.orders.index') }}" class="btn" style="background: var(--gray);">Quay lại danh sách</a>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
    <div style="background: var(--dark-elevated); padding: 1.5rem; border-radius: 8px; border: 1px solid var(--border);">
        <h4 style="color: var(--primary); margin-bottom: 1rem;">Thông tin Khách hàng</h4>
        <p style="color: var(--light); margin-bottom: 0.5rem;"><strong>Tên KH:</strong> {{ $order->TenKhachHang }}</p>
        <p style="color: var(--light); margin-bottom: 0.5rem;"><strong>Email:</strong> {{ $order->Email }}</p>
        <p style="color: var(--light); margin-bottom: 0.5rem;"><strong>Số điện thoại:</strong> {{ $order->DienThoai }}</p>
        <p style="color: var(--light); margin-bottom: 0.5rem;"><strong>Địa chỉ giao:</strong> {{ $order->DiaChiGiaoHang }}</p>
    </div>
    
    <div style="background: var(--dark-elevated); padding: 1.5rem; border-radius: 8px; border: 1px solid var(--border);">
        <h4 style="color: var(--primary); margin-bottom: 1rem;">Thông tin Đơn hàng</h4>
        <p style="color: var(--light); margin-bottom: 0.5rem;"><strong>Ngày đặt:</strong> {{ \Carbon\Carbon::parse($order->NgayDat)->format('d/m/Y H:i:s') }}</p>
        <p style="color: var(--light); margin-bottom: 0.5rem;"><strong>Phương thức TT:</strong> {{ $order->PhuongThucThanhToan }}</p>
        <p style="color: var(--light); margin-bottom: 0.5rem;"><strong>Trạng thái:</strong> <span style="color: #10b981;">{{ $order->TrangThai }}</span></p>
        <p style="color: var(--light); margin-bottom: 0.5rem;"><strong>Tổng tiền:</strong> <span style="color: var(--primary); font-size: 1.2rem; font-weight: bold;">{{ number_format($order->TongTien, 0, ',', '.') }} ₫</span></p>
    </div>
</div>

<div style="background: var(--dark-elevated); padding: 1.5rem; border-radius: 8px; border: 1px solid var(--border);">
    <h3 style="color: var(--light); margin-bottom: 1rem;">Chi tiết sản phẩm</h3>
    <table>
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $item)
            <tr>
                <td style="display: flex; align-items: center; gap: 1rem;">
                    @if($item->HinhAnh)
                        <img src="{{ (str_starts_with($item->HinhAnh, "http") ? $item->HinhAnh : asset("images/" . $item->HinhAnh)) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                    @endif
                    <span>{{ $item->TenSP }}</span>
                </td>
                <td>{{ number_format($item->DonGia, 0, ',', '.') }} ₫</td>
                <td>{{ $item->SoLuong }}</td>
                <td style="color: var(--primary); font-weight: bold;">{{ number_format($item->DonGia * $item->SoLuong, 0, ',', '.') }} ₫</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div style="max-width: 1000px; margin: 4rem auto; padding: 2rem; background: var(--dark-elevated); border-radius: 16px; border: 1px solid var(--border); box-shadow: var(--shadow-lg);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem;">
        <h2 style="color: var(--light);">Chi tiết đơn hàng #{{ $order->MaHD }}</h2>
        <div style="display: flex; gap: 1rem;">
            @if($order->TrangThai !== 'Đã hoàn thành')
                <form action="{{ route('orders.complete', $order->MaHD) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn" style="background: var(--primary);" onclick="return confirm('Xác nhận bạn đã nhận được hàng và hoàn thành đơn này?')">✅ Đã nhận được hàng</button>
                </form>
            @endif
            <a href="{{ route('orders.index') }}" class="btn" style="background: var(--gray);">Quay lại</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
        <div style="background: rgba(0,0,0,0.2); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border);">
            <h4 style="color: var(--primary); margin-bottom: 1rem;">Thông tin giao hàng</h4>
            <p style="color: var(--gray); margin-bottom: 0.5rem;"><strong>Người nhận:</strong> {{ Auth::user()->name }}</p>
            <p style="color: var(--gray); margin-bottom: 0.5rem;"><strong>SĐT:</strong> {{ $order->DienThoai }}</p>
            <p style="color: var(--gray); margin-bottom: 0.5rem;"><strong>Địa chỉ:</strong> {{ $order->DiaChiGiaoHang }}</p>
        </div>
        <div style="background: rgba(0,0,0,0.2); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border);">
            <h4 style="color: var(--primary); margin-bottom: 1rem;">Thông tin thanh toán</h4>
            <p style="color: var(--gray); margin-bottom: 0.5rem;"><strong>Phương thức:</strong> {{ $order->PhuongThucThanhToan }}</p>
            <p style="color: var(--gray); margin-bottom: 0.5rem;"><strong>Trạng thái ĐH:</strong> <span style="color: #10b981;">{{ $order->TrangThai }}</span></p>
            <p style="color: var(--gray); margin-bottom: 0.5rem;"><strong>Ngày đặt:</strong> {{ \Carbon\Carbon::parse($order->NgayDat)->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <h3 style="color: var(--light); margin-bottom: 1rem;">Sản phẩm đã mua</h3>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 2px solid var(--border);">
                    <th style="padding: 1rem;">Sản phẩm</th>
                    <th style="padding: 1rem;">Đơn giá</th>
                    <th style="padding: 1rem;">Số lượng</th>
                    <th style="padding: 1rem;">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $item)
                <tr style="border-bottom: 1px solid var(--border);">
                    <td style="padding: 1rem; display: flex; align-items: center; gap: 1rem;">
                        @if($item->HinhAnh)
                            <img src="{{ (str_starts_with($item->HinhAnh, "http") ? $item->HinhAnh : asset("images/" . $item->HinhAnh)) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                        @endif
                        <span style="color: var(--light);">{{ $item->TenSP }}</span>
                    </td>
                    <td style="padding: 1rem; color: var(--gray);">{{ number_format($item->DonGia, 0, ',', '.') }} ₫</td>
                    <td style="padding: 1rem; color: var(--light);">{{ $item->SoLuong }}</td>
                    <td style="padding: 1rem; color: var(--primary); font-weight: bold;">{{ number_format($item->DonGia * $item->SoLuong, 0, ',', '.') }} ₫</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right; padding: 1.5rem 1rem; color: var(--light); font-size: 1.2rem;">Tổng tiền:</td>
                    <td style="padding: 1.5rem 1rem; color: var(--primary); font-weight: bold; font-size: 1.5rem;">{{ number_format($order->TongTien, 0, ',', '.') }} ₫</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

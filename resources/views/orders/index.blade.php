@extends('layouts.app')

@section('content')
<div style="max-width: 1000px; margin: 4rem auto; padding: 2rem; background: var(--dark-elevated); border-radius: 16px; border: 1px solid var(--border); box-shadow: var(--shadow-lg);">
    <h2 style="margin-bottom: 2rem; color: var(--primary);">Đơn hàng của tôi</h2>

    @if($orders->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--border);">
                        <th style="padding: 1rem;">Mã ĐH</th>
                        <th style="padding: 1rem;">Ngày đặt</th>
                        <th style="padding: 1rem;">Tổng tiền</th>
                        <th style="padding: 1rem;">Trạng thái</th>
                        <th style="padding: 1rem;">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr style="border-bottom: 1px solid var(--border);">
                        <td style="padding: 1rem; color: var(--light);">#{{ $order->MaHD }}</td>
                        <td style="padding: 1rem; color: var(--gray);">{{ \Carbon\Carbon::parse($order->NgayDat)->format('d/m/Y H:i') }}</td>
                        <td style="padding: 1rem; color: var(--primary); font-weight: bold;">{{ number_format($order->TongTien, 0, ',', '.') }} ₫</td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.3rem 0.8rem; background: rgba(16, 185, 129, 0.1); color: #10b981; border-radius: 20px; font-size: 0.9rem;">
                                {{ $order->TrangThai }}
                            </span>
                        </td>
                        <td style="padding: 1rem;">
                            <a href="{{ route('orders.show', $order->MaHD) }}" class="btn" style="padding: 0.4rem 1rem; font-size: 0.9rem;">Xem</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="text-align: center; padding: 4rem 0;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">📦</div>
            <p style="color: var(--gray); font-size: 1.2rem; margin-bottom: 1.5rem;">Bạn chưa có đơn hàng nào.</p>
            <a href="{{ route('home') }}" class="btn">Mua sắm ngay</a>
        </div>
    @endif
</div>
@endsection

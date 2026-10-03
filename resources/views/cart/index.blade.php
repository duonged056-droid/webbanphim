@extends('layouts.app')

@section('content')
<div style="max-width: 1000px; margin: 4rem auto; padding: 2rem; background: var(--dark-elevated); border-radius: 16px; border: 1px solid var(--border); box-shadow: var(--shadow-lg);">
    <h1 style="margin-bottom: 2rem; color: var(--primary);">Giỏ hàng của bạn</h1>

    @if(count($cart) > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--border);">
                        <th style="padding: 1rem;">Sản phẩm</th>
                        <th style="padding: 1rem;">Đơn giá</th>
                        <th style="padding: 1rem;">Số lượng</th>
                        <th style="padding: 1rem;">Tạm tính</th>
                        <th style="padding: 1rem;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                    <tr style="border-bottom: 1px solid var(--border);">
                        <td style="padding: 1rem; display: flex; align-items: center; gap: 1rem;">
                            @if($item['image'])
                                <img src="{{ (str_starts_with($item['image'], "http") ? $item['image'] : asset("images/" . $item['image'])) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                            @else
                                <div style="width: 60px; height: 60px; background: var(--border); border-radius: 8px;"></div>
                            @endif
                            <strong>{{ $item['name'] }}</strong>
                        </td>
                        <td style="padding: 1rem;">{{ number_format($item['price'], 0, ',', '.') }} ₫</td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.3rem 0.8rem; background: var(--darker); border-radius: 8px; border: 1px solid var(--border);">{{ $item['quantity'] }}</span>
                        </td>
                        <td style="padding: 1rem; color: var(--accent); font-weight: bold;">
                            {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} ₫
                        </td>
                        <td style="padding: 1rem;">
                            <a href="{{ route('cart.remove', $id) }}" style="color: #ef4444; text-decoration: none; font-weight: 500; background: rgba(239,68,68,0.1); padding: 0.4rem 0.8rem; border-radius: 6px;">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <a href="{{ route('home') }}" class="btn" style="background: var(--border);">Tiếp tục mua sắm</a>
            <div style="text-align: right;">
                <h3>Tổng thanh toán: <span style="color: var(--primary); font-size: 1.8rem;">{{ number_format($total, 0, ',', '.') }} ₫</span></h3>
                <div style="margin-top: 1rem;">
                    <a href="{{ route('checkout.index') }}" class="btn" style="background: #10b981; padding: 0.8rem 2rem; font-size: 1.1rem;">Thanh toán ngay</a>
                </div>
            </div>
        </div>
    @else
        <div style="text-align: center; padding: 4rem 0;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">🛒</div>
            <p style="color: var(--gray); font-size: 1.2rem; margin-bottom: 1.5rem;">Giỏ hàng của bạn đang trống.</p>
            <a href="{{ route('home') }}" class="btn">Quay lại mua sắm</a>
        </div>
    @endif
</div>
@endsection

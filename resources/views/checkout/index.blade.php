@extends('layouts.app')

@section('content')
<div style="max-width: 1000px; margin: 0 auto;">
    <h2 style="font-size: 2rem; color: var(--light); margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem;">Thanh toán đơn hàng</h2>

    @if(session('error'))
        <div style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid rgba(239, 68, 68, 0.2);">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        @csrf
        <!-- Cột thông tin -->
        <div style="background: var(--dark-elevated); border: 1px solid var(--border); border-radius: 12px; padding: 2rem;">
            <h3 style="color: var(--light); margin-bottom: 1.5rem;">Thông tin giao hàng</h3>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: var(--gray); margin-bottom: 0.5rem; font-size: 0.9rem;">Họ tên</label>
                <input type="text" value="{{ Auth::user()->name }}" disabled style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: rgba(0,0,0,0.2); color: var(--gray); font-family: inherit; cursor: not-allowed;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: var(--gray); margin-bottom: 0.5rem; font-size: 0.9rem;">Số điện thoại *</label>
                <input type="text" name="DienThoai" required placeholder="Nhập số điện thoại liên hệ" style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); font-family: inherit; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: var(--gray); margin-bottom: 0.5rem; font-size: 0.9rem;">Địa chỉ giao hàng *</label>
                <textarea name="DiaChiGiaoHang" required placeholder="Nhập địa chỉ nhận hàng chi tiết (Số nhà, đường, phường/xã, quận/huyện...)" rows="3" style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); font-family: inherit; outline: none; resize: vertical; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'"></textarea>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: var(--gray); margin-bottom: 0.5rem; font-size: 0.9rem;">Phương thức thanh toán *</label>
                <select name="PhuongThucThanhToan" required style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); font-family: inherit; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
                    <option value="Thanh toán khi nhận hàng (COD)">Thanh toán khi nhận hàng (COD)</option>
                    <option value="Chuyển khoản ngân hàng">Chuyển khoản ngân hàng</option>
                    <option value="Ví điện tử Momo">Ví điện tử Momo/ZaloPay</option>
                </select>
            </div>
        </div>

        <!-- Cột đơn hàng -->
        <div style="background: var(--dark-elevated); border: 1px solid var(--border); border-radius: 12px; padding: 2rem; height: fit-content;">
            <h3 style="color: var(--light); margin-bottom: 1.5rem;">Tóm tắt đơn hàng</h3>
            
            <div style="margin-bottom: 1.5rem; max-height: 300px; overflow-y: auto; padding-right: 0.5rem;">
                @foreach($cart as $item)
                    <div style="display: flex; gap: 1rem; margin-bottom: 1rem; align-items: center;">
                        <img src="{{ (str_starts_with($item['image'], "http") ? $item['image'] : asset("images/" . $item['image'])) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border);">
                        <div style="flex: 1;">
                            <h4 style="color: var(--light); font-size: 0.9rem; margin-bottom: 0.3rem;">{{ $item['name'] }}</h4>
                            <div style="color: var(--gray); font-size: 0.85rem;">Số lượng: {{ $item['quantity'] }}</div>
                        </div>
                        <div style="color: var(--primary); font-weight: bold; font-size: 0.9rem;">
                            {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="border-top: 1px solid var(--border); padding-top: 1.5rem; margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <span style="color: var(--gray);">Tạm tính</span>
                    <span style="color: var(--light);">{{ number_format($total, 0, ',', '.') }} đ</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <span style="color: var(--gray);">Phí vận chuyển</span>
                    <span style="color: var(--light);">Miễn phí</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed var(--border);">
                    <span style="color: var(--light); font-weight: bold; font-size: 1.1rem;">Tổng cộng</span>
                    <span style="color: var(--primary); font-weight: bold; font-size: 1.5rem;">{{ number_format($total, 0, ',', '.') }} đ</span>
                </div>
            </div>

            <button type="submit" class="btn" style="width: 100%; padding: 1rem; font-size: 1.1rem; border-radius: 8px;">Xác nhận đặt hàng</button>
            <div style="text-align: center; margin-top: 1rem;">
                <a href="{{ route('cart.index') }}" style="color: var(--gray); text-decoration: none; font-size: 0.9rem;">&larr; Quay lại giỏ hàng</a>
            </div>
        </div>
    </form>
</div>

<!-- Thêm chút CSS cho ô input bị disabled và scrollbar -->
<style>
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--gray); }
    
    @media (max-width: 768px) {
        form { grid-template-columns: 1fr !important; }
    }
</style>
@endsection

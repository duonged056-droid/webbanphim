@extends('layouts.app')

@section('styles')
<style>
    .detail-container {
        max-width: 1000px;
        margin: 4rem auto;
        padding: 2rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        background: var(--dark);
        border: 1px solid var(--border);
        border-radius: 20px;
    }
    @media(max-width: 768px) {
        .detail-container {
            grid-template-columns: 1fr;
        }
    }
    .detail-img {
        width: 100%;
        border-radius: 12px;
        background: #1e293b;
        height: 400px;
        object-fit: cover;
    }
    .detail-info h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    .detail-info .price {
        font-size: 2rem;
        color: #fbbf24;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }
    .detail-info .desc {
        color: var(--gray);
        margin-bottom: 2rem;
        line-height: 1.8;
    }
    .badge {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        background: rgba(99, 102, 241, 0.2);
        color: var(--primary);
        border-radius: 20px;
        font-weight: 600;
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
<div class="detail-container">
    <div>
        @if($sanpham->HinhAnh)
            <img src="{{ (str_starts_with($sanpham->HinhAnh, "http") ? $sanpham->HinhAnh : asset("images/" . $sanpham->HinhAnh)) }}" alt="{{ $sanpham->TenSP }}" class="detail-img">
        @else
            <div class="detail-img" style="display:flex; align-items:center; justify-content:center; font-size:5rem;">⌨️</div>
        @endif
    </div>
    <div class="detail-info">
        <span class="badge">{{ $sanpham->LoaiSP }}</span>
        <h1>{{ $sanpham->TenSP }}</h1>
        <div class="price">{{ number_format($sanpham->GiaBan, 0, ',', '.') }} VNĐ</div>
        <div class="desc">
            <strong>Mô tả:</strong><br>
            {{ $sanpham->MoTa ?: 'Chưa có mô tả' }}
        </div>
        <p style="margin-bottom: 1.5rem;"><strong>Tình trạng:</strong> {{ $sanpham->SoLuongTon > 0 ? 'Còn hàng' : 'Hết hàng' }}</p>
        
        @if(Auth::check())
            <form action="{{ route('cart.add', $sanpham->MaSP) }}" method="POST">
                @csrf
                <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                    <input type="number" name="quantity" value="1" min="1" max="{{ $sanpham->SoLuongTon }}" style="width: 80px; padding: 0.5rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: white;">
                    <button type="submit" class="btn" style="flex: 1;" {{ $sanpham->SoLuongTon == 0 ? 'disabled' : '' }}>Thêm vào giỏ</button>
                </div>
            </form>
        @else
            <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                <a href="{{ route('login') }}" class="btn" style="flex: 1; text-align: center; background: var(--border);">Đăng nhập để mua hàng</a>
            </div>
        @endif
    </div>
</div>
@endsection

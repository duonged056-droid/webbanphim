@extends('layouts.app')

@section('content')
<div style="max-width: 1000px; margin: 4rem auto; padding: 2rem; background: var(--dark-elevated); border-radius: 16px; border: 1px solid var(--border); box-shadow: var(--shadow-lg);">
    <h2 style="margin-bottom: 0.5rem; color: var(--primary);">🛠️ Tự Build Bàn Phím Custom</h2>
    <p style="color: var(--gray); margin-bottom: 2rem;">Chọn cấu hình theo sở thích của bạn, shop sẽ lắp ráp và gửi đến tận tay bạn!</p>

    <form action="{{ route('build.process') }}" method="POST">
        @csrf
        
        <!-- Chọn Kit -->
        <div style="margin-bottom: 2.5rem; background: rgba(0,0,0,0.1); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border);">
            <h3 style="color: var(--light); margin-bottom: 1rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem;">1. Chọn Kit (Bàn phím)</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                @foreach($kits as $kit)
                <label style="display: block; cursor: pointer;">
                    <input type="radio" name="kit_id" value="{{ $kit->MaSP }}" style="display: none;" required>
                    <div class="build-option" style="border: 2px solid var(--border); border-radius: 12px; padding: 1rem; text-align: center; transition: all 0.2s;">
                        <img src="{{ (str_starts_with($kit->HinhAnh, "http") ? $kit->HinhAnh : asset("images/" . $kit->HinhAnh)) }}" alt="" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; margin-bottom: 0.5rem; background: #fff;">
                        <h4 style="color: var(--light); font-size: 0.95rem; margin-bottom: 0.5rem;">{{ $kit->TenSP }}</h4>
                        <p style="color: var(--primary); font-weight: bold;">{{ number_format($kit->GiaBan, 0, ',', '.') }} ₫</p>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Chọn Switch -->
        <div style="margin-bottom: 2.5rem; background: rgba(0,0,0,0.1); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border);">
            <h3 style="color: var(--light); margin-bottom: 1rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem;">2. Chọn Switch</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                @foreach($switches as $switch)
                <label style="display: block; cursor: pointer;">
                    <input type="radio" name="switch_id" value="{{ $switch->MaSP }}" style="display: none;" required>
                    <div class="build-option" style="border: 2px solid var(--border); border-radius: 12px; padding: 1rem; text-align: center; transition: all 0.2s;">
                        <img src="{{ (str_starts_with($switch->HinhAnh, "http") ? $switch->HinhAnh : asset("images/" . $switch->HinhAnh)) }}" alt="" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; margin-bottom: 0.5rem; background: #fff;">
                        <h4 style="color: var(--light); font-size: 0.95rem; margin-bottom: 0.5rem;">{{ $switch->TenSP }}</h4>
                        <p style="color: var(--primary); font-weight: bold;">{{ number_format($switch->GiaBan, 0, ',', '.') }} ₫ <small>/box</small></p>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Chọn Keycap -->
        <div style="margin-bottom: 2.5rem; background: rgba(0,0,0,0.1); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border);">
            <h3 style="color: var(--light); margin-bottom: 1rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem;">3. Chọn Keycap</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                @foreach($keycaps as $keycap)
                <label style="display: block; cursor: pointer;">
                    <input type="radio" name="keycap_id" value="{{ $keycap->MaSP }}" style="display: none;" required>
                    <div class="build-option" style="border: 2px solid var(--border); border-radius: 12px; padding: 1rem; text-align: center; transition: all 0.2s;">
                        <img src="{{ (str_starts_with($keycap->HinhAnh, "http") ? $keycap->HinhAnh : asset("images/" . $keycap->HinhAnh)) }}" alt="" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; margin-bottom: 0.5rem; background: #fff;">
                        <h4 style="color: var(--light); font-size: 0.95rem; margin-bottom: 0.5rem;">{{ $keycap->TenSP }}</h4>
                        <p style="color: var(--primary); font-weight: bold;">{{ number_format($keycap->GiaBan, 0, ',', '.') }} ₫</p>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        <div style="text-align: right;">
            <button type="submit" class="btn" style="padding: 1rem 3rem; font-size: 1.2rem; background: #10b981;">🛒 Thêm Combo Vào Giỏ</button>
        </div>
    </form>
</div>

<style>
    input[type="radio"]:checked + .build-option {
        border-color: var(--primary) !important;
        background: rgba(16, 185, 129, 0.1);
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
    }
    .build-option:hover {
        border-color: var(--gray);
    }
</style>
@endsection

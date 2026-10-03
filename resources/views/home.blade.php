@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div style="position: relative; height: 500px; background: linear-gradient(to right, var(--darker), transparent), url('https://images.unsplash.com/photo-1595225476474-87563907a212?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover; display: flex; align-items: center; border-bottom: 1px solid var(--border);">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem; width: 100%;">
        <span style="background: var(--primary); color: white; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: bold; letter-spacing: 1px;">NEW ARRIVAL</span>
        <h1 style="font-size: 3.5rem; margin: 1rem 0; line-height: 1.2; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">Nâng Tầm<br>Trải Nghiệm Gõ Phím</h1>
        <p style="font-size: 1.1rem; color: var(--gray); max-width: 500px; margin-bottom: 2rem; font-weight: 500;">Khám phá bộ sưu tập bàn phím cơ custom, switch và keycap cao cấp nhất năm 2026. Thiết kế dành riêng cho bạn.</p>
        <a href="#products" class="btn" style="font-size: 1.2rem; padding: 0.8rem 2.5rem; border-radius: 30px;">Mua ngay hôm nay</a>
    </div>
</div>

<div style="max-width: 1200px; margin: 4rem auto; padding: 0 2rem;">
    <!-- Featured Categories -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 5rem;">
        <div style="background: var(--dark-elevated); padding: 2rem; border-radius: 16px; border: 1px solid var(--border); text-align: center; transition: all 0.3s; cursor: pointer; box-shadow: var(--shadow-sm);" onmouseover="this.style.transform='translateY(-5px)'; this.style.borderColor='var(--primary)';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='var(--border)';">
            <div style="font-size: 2.5rem; margin-bottom: 1rem;">⌨️</div>
            <h3 style="color: var(--light); margin-bottom: 0.5rem;">Bàn Phím Cơ</h3>
            <p style="color: var(--gray); font-size: 0.9rem;">Layout 75%, TKL, Fullsize</p>
        </div>
        <div style="background: var(--dark-elevated); padding: 2rem; border-radius: 16px; border: 1px solid var(--border); text-align: center; transition: all 0.3s; cursor: pointer; box-shadow: var(--shadow-sm);" onmouseover="this.style.transform='translateY(-5px)'; this.style.borderColor='var(--secondary)';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='var(--border)';">
            <div style="font-size: 2.5rem; margin-bottom: 1rem;">🎛️</div>
            <h3 style="color: var(--light); margin-bottom: 0.5rem;">Switch Custom</h3>
            <p style="color: var(--gray); font-size: 0.9rem;">Linear, Tactile, Clicky</p>
        </div>
        <div style="background: var(--dark-elevated); padding: 2rem; border-radius: 16px; border: 1px solid var(--border); text-align: center; transition: all 0.3s; cursor: pointer; box-shadow: var(--shadow-sm);" onmouseover="this.style.transform='translateY(-5px)'; this.style.borderColor='var(--accent)';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='var(--border)';">
            <div style="font-size: 2.5rem; margin-bottom: 1rem;">🎨</div>
            <h3 style="color: var(--light); margin-bottom: 0.5rem;">Keycap Sets</h3>
            <p style="color: var(--gray); font-size: 0.9rem;">Cherry, SA, MDA profile</p>
        </div>
    </div>

    <!-- Search Form -->
    <div style="background: var(--dark-elevated); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border); margin-bottom: 2rem; box-shadow: var(--shadow-sm);">
        <form action="{{ route('home') }}#products" method="GET" style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: flex-end;">
            <div style="flex: 1; min-width: 250px;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--gray); font-size: 0.9rem; font-weight: 500;">Tìm kiếm theo tên sản phẩm</label>
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="VD: Bàn phím Logitech, Switch Cherry..." style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); font-family: inherit; outline: none;">
            </div>
            <div style="width: 150px;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--gray); font-size: 0.9rem; font-weight: 500;">Tồn kho từ</label>
                <input type="number" name="min_stock" value="{{ request('min_stock') }}" min="0" style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); outline: none;">
            </div>
            <div style="width: 180px;">
                <label style="display: block; margin-bottom: 0.5rem; color: var(--gray); font-size: 0.9rem; font-weight: 500;">Sắp xếp theo</label>
                <select name="sort" style="width: 100%; padding: 0.8rem 1rem; border-radius: 8px; border: 1px solid var(--border); background: var(--darker); color: var(--light); outline: none;">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                </select>
            </div>
            <button type="submit" class="btn" style="padding: 0.8rem 2rem; border-radius: 8px;">🔍 Lọc</button>
            @if(request('keyword') || request('min_stock') || request('category') || request('sort'))
                <a href="{{ route('home') }}#products" class="btn" style="background: var(--gray); padding: 0.8rem 1.5rem; border-radius: 8px;">❌ Hủy</a>
            @endif
            
            <input type="hidden" name="category" value="{{ request('category') }}">
        </form>
    </div>

    <!-- Category Filters -->
    <div style="display: flex; gap: 1rem; margin-bottom: 3rem; flex-wrap: wrap;">
        <a href="{{ route('home', array_merge(request()->query(), ['category' => ''])) }}#products" 
           style="padding: 0.5rem 1.2rem; border-radius: 20px; text-decoration: none; font-weight: 500; font-size: 0.95rem; border: 1px solid var(--border); {{ !request('category') ? 'background: var(--primary); color: white; border-color: var(--primary);' : 'background: transparent; color: var(--gray);' }}">
            Tất cả
        </a>
        @if(isset($categories))
            @foreach($categories as $cat)
                <a href="{{ route('home', array_merge(request()->query(), ['category' => $cat])) }}#products" 
                   style="padding: 0.5rem 1.2rem; border-radius: 20px; text-decoration: none; font-weight: 500; font-size: 0.95rem; border: 1px solid var(--border); {{ request('category') == $cat ? 'background: var(--primary); color: white; border-color: var(--primary);' : 'background: transparent; color: var(--gray);' }}">
                    {{ $cat }}
                </a>
            @endforeach
        @endif
    </div>

    <!-- Products Section -->
    <div id="products" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; border-bottom: 2px solid var(--border); padding-bottom: 1rem;">
        <h2 style="font-size: 2rem; color: var(--light); position: relative;">
            Danh sách sản phẩm
            <div style="position: absolute; bottom: -18px; left: 0; width: 60px; height: 4px; background: var(--primary); border-radius: 2px;"></div>
        </h2>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 2rem; padding-bottom: 3rem;">
        @forelse($sanphams as $sp)
            <div style="background: var(--dark-elevated); border-radius: 16px; overflow: hidden; border: 1px solid var(--border); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; display: flex; flex-direction: column;" 
                 onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='var(--shadow-lg)'; this.querySelector('.quick-add').style.bottom='1rem';" 
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.querySelector('.quick-add').style.bottom='-4rem';">
                
                <!-- Badges -->
                <div style="position: absolute; top: 1rem; left: 1rem; background: #ef4444; color: white; padding: 0.2rem 0.6rem; border-radius: 6px; font-size: 0.75rem; font-weight: bold; z-index: 10;">HOT</div>
                
                <!-- Image Wrapper -->
                <a href="{{ route('detail', $sp->MaSP) }}" style="display: block; height: 260px; overflow: hidden; background: #fff;">
                    @if($sp->HinhAnh)
                        <img src="{{ (str_starts_with($sp->HinhAnh, "http") ? $sp->HinhAnh : asset("images/" . $sp->HinhAnh)) }}" alt="{{ $sp->TenSP }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    @else
                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f1f5f9; color: #94a3b8;">Chưa có ảnh</div>
                    @endif
                </a>
                
                <!-- Info -->
                <div style="padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column; background: var(--dark-elevated); position: relative; z-index: 5;">
                    <div style="color: var(--gray); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; font-weight: 600;">{{ $sp->LoaiSP }}</div>
                    <a href="{{ route('detail', $sp->MaSP) }}">
                        <h3 style="font-size: 1.1rem; margin-bottom: 1rem; color: var(--light); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--light)'">{{ $sp->TenSP }}</h3>
                    </a>
                    <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.3rem; font-weight: 800; color: var(--accent);">{{ number_format($sp->GiaBan, 0, ',', '.') }} ₫</span>
                        <span style="font-size: 0.8rem; color: var(--gray); background: rgba(148, 163, 184, 0.1); padding: 0.2rem 0.6rem; border-radius: 4px;">Đã bán 120</span>
                    </div>
                </div>

                <!-- Quick Add Form (Hidden by default, slides up on hover) -->
                <div class="quick-add" style="position: absolute; bottom: -4rem; left: 0; width: 100%; padding: 0 1rem; transition: bottom 0.3s cubic-bezier(0.4, 0, 0.2, 1); z-index: 20;">
                    @if(Auth::check())
                        <form action="{{ route('cart.add', $sp->MaSP) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn" style="width: 100%; background: var(--primary); padding: 0.8rem; border-radius: 8px; font-weight: 600; box-shadow: 0 4px 6px rgba(99, 102, 241, 0.4);" {{ $sp->SoLuongTon == 0 ? 'disabled' : '' }}>
                                🛒 {{ $sp->SoLuongTon > 0 ? 'Thêm vào giỏ nhanh' : 'Hết hàng' }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn" style="width: 100%; background: var(--border); padding: 0.8rem; border-radius: 8px; font-weight: 600; text-align: center; display: block; box-shadow: 0 4px 6px rgba(0,0,0,0.2);">Đăng nhập để mua</a>
                    @endif
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 4rem; background: var(--dark-elevated); border-radius: 12px; border: 1px dashed var(--border);">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📦</div>
                <p style="color: var(--gray); font-size: 1.2rem;">Kho hàng hiện đang trống. Quay lại sau nhé!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

@extends('admin.layout')

@section('content')
<div style="background: var(--dark); padding: 2rem; border-radius: 8px;">
    <h2 style="margin-bottom: 2rem;">Cập nhật Sản Phẩm</h2>
    
    <form action="{{ route('admin.sanpham.update', $sanpham->MaSP) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Tên sản phẩm</label>
            <input type="text" name="TenSP" class="form-control" value="{{ $sanpham->TenSP }}" required>
        </div>
        <div class="form-group">
            <label>Loại sản phẩm</label>
            <select name="LoaiSP" class="form-control" required>
                <option value="Bàn phím cơ" {{ $sanpham->LoaiSP == 'Bàn phím cơ' ? 'selected' : '' }}>Bàn phím cơ</option>
                <option value="Kit bàn phím" {{ $sanpham->LoaiSP == 'Kit bàn phím' ? 'selected' : '' }}>Kit bàn phím</option>
                <option value="Switch" {{ $sanpham->LoaiSP == 'Switch' ? 'selected' : '' }}>Switch</option>
                <option value="Keycap" {{ $sanpham->LoaiSP == 'Keycap' ? 'selected' : '' }}>Keycap</option>
                <option value="Phụ kiện khác" {{ $sanpham->LoaiSP == 'Phụ kiện khác' ? 'selected' : '' }}>Phụ kiện khác</option>
            </select>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label>Giá bán (VNĐ)</label>
                <input type="number" name="GiaBan" class="form-control" value="{{ $sanpham->GiaBan }}" required>
            </div>
            <div class="form-group">
                <label>Số lượng tồn</label>
                <input type="number" name="SoLuongTon" class="form-control" value="{{ $sanpham->SoLuongTon }}" required>
            </div>
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="MoTa" rows="5" class="form-control">{{ $sanpham->MoTa }}</textarea>
        </div>
        <div class="form-group">
            <label>Hình ảnh (Để trống nếu không muốn đổi)</label>
            <input type="file" name="HinhAnh" class="form-control" accept="image/*">
            @if($sanpham->HinhAnh)
                <div style="margin-top: 10px;">
                    <img src="{{ (str_starts_with($sanpham->HinhAnh, "http") ? $sanpham->HinhAnh : asset("images/" . $sanpham->HinhAnh)) }}" width="150" style="border-radius: 8px;">
                </div>
            @endif
        </div>
        
        <button type="submit" class="btn">Cập nhật sản phẩm</button>
        <a href="{{ route('admin.sanpham.index') }}" class="btn" style="background: var(--border);">Hủy</a>
    </form>
</div>
@endsection

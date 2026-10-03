@extends('admin.layout')

@section('content')
<div style="background: var(--dark); padding: 2rem; border-radius: 8px;">
    <h2 style="margin-bottom: 2rem;">Thêm Sản Phẩm Mới</h2>
    
    <form action="{{ route('admin.sanpham.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Tên sản phẩm</label>
            <input type="text" name="TenSP" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Loại sản phẩm</label>
            <select name="LoaiSP" class="form-control" required>
                <option value="Bàn phím cơ">Bàn phím cơ</option>
                <option value="Kit bàn phím">Kit bàn phím</option>
                <option value="Switch">Switch</option>
                <option value="Keycap">Keycap</option>
                <option value="Phụ kiện khác">Phụ kiện khác</option>
            </select>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label>Giá bán (VNĐ)</label>
                <input type="number" name="GiaBan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Số lượng tồn</label>
                <input type="number" name="SoLuongTon" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="MoTa" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Hình ảnh</label>
            <input type="file" name="HinhAnh" class="form-control" accept="image/*">
        </div>
        
        <button type="submit" class="btn">Lưu sản phẩm</button>
        <a href="{{ route('admin.sanpham.index') }}" class="btn" style="background: var(--border);">Hủy</a>
    </form>
</div>
@endsection

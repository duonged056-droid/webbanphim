@extends('admin.layout')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2>Danh sách Sản Phẩm</h2>
    <a href="{{ route('admin.sanpham.create') }}" class="btn">Thêm sản phẩm mới</a>
</div>

<div style="background: rgba(0,0,0,0.15); padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem; border: 1px solid var(--border);">
    <form action="{{ route('admin.sanpham.index') }}" method="GET" style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: flex-end;">
        <div style="flex: 1; min-width: 250px;">
            <label style="display: block; margin-bottom: 0.5rem; color: var(--gray); font-size: 0.9rem;">Tên sản phẩm</label>
            <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Gõ để tìm kiếm..." style="background: var(--darker); border-color: var(--border);">
        </div>
        <div style="width: 250px;">
            <label style="display: block; margin-bottom: 0.5rem; color: var(--gray); font-size: 0.9rem;">Tồn kho (Bé hơn hoặc bằng)</label>
            <input type="number" name="stock" value="{{ request('stock') }}" class="form-control" placeholder="VD: 5 (để tìm hàng sắp hết)" style="background: var(--darker); border-color: var(--border);">
        </div>
        <button type="submit" class="btn" style="padding: 0.8rem 2rem;">🔍 Lọc</button>
        @if(request('keyword') || request('stock') !== null)
            <a href="{{ route('admin.sanpham.index') }}" class="btn" style="background: var(--border); padding: 0.8rem 1.5rem;">❌ Hủy</a>
        @endif
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Loại</th>
            <th>Giá</th>
            <th>Tồn kho</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sanphams as $sp)
        <tr>
            <td>{{ $sp->MaSP }}</td>
            <td>
                @if($sp->HinhAnh)
                    <img src="{{ (str_starts_with($sp->HinhAnh, "http") ? $sp->HinhAnh : asset("images/" . $sp->HinhAnh)) }}" width="60" style="border-radius: 4px;">
                @else
                    Không có
                @endif
            </td>
            <td>{{ $sp->TenSP }}</td>
            <td>{{ $sp->LoaiSP }}</td>
            <td>{{ number_format($sp->GiaBan, 0, ',', '.') }} đ</td>
            <td>{{ $sp->SoLuongTon }}</td>
            <td>
                <a href="{{ route('admin.sanpham.edit', $sp->MaSP) }}" class="btn" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Sửa</a>
                <form action="{{ route('admin.sanpham.destroy', $sp->MaSP) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

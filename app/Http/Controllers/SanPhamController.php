<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SanPhamController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm (Admin)
     */
    public function index(Request $request)
    {
        $query = SanPham::query();

        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('TenSP', 'like', '%' . $request->keyword . '%');
        }

        if ($request->has('stock') && $request->stock != '') {
            // Lọc các sản phẩm có tồn kho bé hơn hoặc bằng mức nhập vào (để dễ tìm hàng sắp hết)
            $query->where('SoLuongTon', '<=', $request->stock);
        }

        $sanphams = $query->orderBy('MaSP', 'desc')->paginate(20);
        // appends request params to pagination links
        $sanphams->appends($request->all());
        
        return view('admin.sanpham.index', compact('sanphams'));
    }

    /**
     * Form thêm mới
     */
    public function create()
    {
        return view('admin.sanpham.create');
    }

    /**
     * Lưu sản phẩm mới
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'TenSP'      => 'required|string|max:200',
            'LoaiSP'     => 'required|string|max:50',
            'GiaBan'     => 'required|numeric|min:0',
            'SoLuongTon' => 'required|integer|min:0',
            'MoTa'       => 'nullable|string',
            'HinhAnh'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ], [
            'TenSP.required' => 'Vui lòng nhập tên sản phẩm.',
            'GiaBan.numeric' => 'Giá bán phải là số.',
            'HinhAnh.image'  => 'File upload phải là định dạng hình ảnh.'
        ]);

        try {
            if ($request->hasFile('HinhAnh')) {
                $image = $request->file('HinhAnh');
                $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $name);
                $validatedData['HinhAnh'] = $name;
            }

            SanPham::create($validatedData);
            
            return redirect()->route('admin.sanpham.index')->with('success', 'Thêm sản phẩm thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm sản phẩm: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau!')->withInput();
        }
    }

    /**
     * Form chỉnh sửa
     */
    public function edit($id)
    {
        $sanpham = SanPham::findOrFail($id);
        return view('admin.sanpham.edit', compact('sanpham'));
    }

    /**
     * Cập nhật sản phẩm
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'TenSP'      => 'required|string|max:200',
            'LoaiSP'     => 'required|string|max:50',
            'GiaBan'     => 'required|numeric|min:0',
            'SoLuongTon' => 'required|integer|min:0',
            'MoTa'       => 'nullable|string',
            'HinhAnh'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        try {
            $sanpham = SanPham::findOrFail($id);

            if ($request->hasFile('HinhAnh')) {
                // Xóa ảnh cũ nếu có
                if ($sanpham->HinhAnh && File::exists(public_path('images/' . $sanpham->HinhAnh))) {
                    File::delete(public_path('images/' . $sanpham->HinhAnh));
                }

                $image = $request->file('HinhAnh');
                $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/images'), $name);
                $validatedData['HinhAnh'] = $name;
            } else {
                $validatedData['HinhAnh'] = $sanpham->HinhAnh;
            }

            $sanpham->update($validatedData);
            
            return redirect()->route('admin.sanpham.index')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật sản phẩm: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau!')->withInput();
        }
    }

    /**
     * Xóa sản phẩm
     */
    public function destroy($id)
    {
        try {
            $sanpham = SanPham::findOrFail($id);
            
            // Xóa file ảnh vật lý
            if ($sanpham->HinhAnh && File::exists(public_path('images/' . $sanpham->HinhAnh))) {
                File::delete(public_path('images/' . $sanpham->HinhAnh));
            }
            
            $sanpham->delete();
            return redirect()->route('admin.sanpham.index')->with('success', 'Xóa sản phẩm thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa sản phẩm: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra, không thể xóa sản phẩm!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = SanPham::query();

        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('TenSP', 'like', '%' . $request->keyword . '%');
        }

        if ($request->has('min_stock') && $request->min_stock != '') {
            $query->where('SoLuongTon', '>=', $request->min_stock);
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('LoaiSP', $request->category);
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('GiaBan', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('GiaBan', 'desc');
                    break;
                case 'newest':
                default:
                    $query->orderBy('MaSP', 'desc');
                    break;
            }
        } else {
            $query->orderBy('MaSP', 'desc');
        }

        $categories = SanPham::select('LoaiSP')->distinct()->pluck('LoaiSP');
        $sanphams = $query->paginate(12)->withQueryString();

        return view('home', compact('sanphams', 'categories'));
    }

    public function detail($id)
    {
        $sanpham = SanPham::with(['danhGiaDaDuyet.user'])->findOrFail($id);
        $danhGias = $sanpham->danhGiaDaDuyet()->latest()->get();
        return view('detail', compact('sanpham', 'danhGias'));
    }

    public function themDanhGia(Request $request, $id)
    {
        $request->validate([
            'so_sao'   => 'required|integer|min:1|max:5',
            'tieu_de'  => 'nullable|string|max:200',
            'noi_dung' => 'required|string|max:1000',
        ], [
            'noi_dung.required' => 'Vui lòng nhập nội dung đánh giá.',
        ]);

        \App\Models\DanhGia::create([
            'user_id'  => auth()->id(),
            'MaSP'     => $id,
            'so_sao'   => $request->so_sao,
            'tieu_de'  => $request->tieu_de,
            'noi_dung' => $request->noi_dung,
            'da_duyet' => true,
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã gửi đánh giá cho sản phẩm!');
    }

    public function contact()
    {
        return view('contact');
    }
}

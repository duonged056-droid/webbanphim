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
        $sanpham = SanPham::findOrFail($id);
        return view('detail', compact('sanpham'));
    }

    public function contact()
    {
        return view('contact');
    }
}

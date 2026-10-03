<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\SanPham;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $tongDoanhThu = HoaDon::where('TrangThai', 'Đã hoàn thành')->sum('TongTien');
        $tongDonHang = HoaDon::count();
        $donChoXuLy = HoaDon::where('TrangThai', 'Đang xử lý')->count();
        $tongSanPham = SanPham::count();
        $tongKhachHang = DB::table('khach_hangs')->count();

        // 5 đơn hàng mới nhất
        $donMoiNhat = HoaDon::select('hoa_dons.*', 'khach_hangs.TenKH as TenKhachHang')
                        ->leftJoin('khach_hangs', 'hoa_dons.MaKH', '=', 'khach_hangs.MaKH')
                        ->orderBy('NgayDat', 'desc')
                        ->take(5)
                        ->get();

        return view('admin.dashboard', compact(
            'tongDoanhThu', 'tongDonHang', 'donChoXuLy', 'tongSanPham', 'tongKhachHang', 'donMoiNhat'
        ));
    }
}

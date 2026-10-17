<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\KhachHang;
use Illuminate\Support\Facades\DB;

/**
 * KhachHangController – Quản lý khách hàng (dành cho Admin)
 */
class KhachHangController extends Controller
{
    /** Danh sách tất cả khách hàng */
    public function index(Request $request)
    {
        $query = User::where('role', 'customer');

        // Tìm kiếm
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('so_dien_thoai', 'like', "%$s%");
            });
        }

        // Lọc trạng thái
        if ($request->filled('trang_thai')) {
            $query->where('is_active', $request->trang_thai === 'active');
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.khach-hang.index', compact('users'));
    }

    /** Chi tiết 1 khách hàng */
    public function show($id)
    {
        $user = User::where('role', 'customer')->findOrFail($id);

        // Tìm KhachHang tương ứng (liên kết qua email)
        $khachHang = DB::table('khach_hangs')->where('Email', $user->email)->first();

        $donHangs = collect();
        $tongChiTieu = 0;
        if ($khachHang) {
            $donHangs = DB::table('hoa_dons')
                ->where('MaKH', $khachHang->MaKH)
                ->orderBy('NgayDat', 'desc')
                ->limit(10)
                ->get();
            $tongChiTieu = DB::table('hoa_dons')
                ->where('MaKH', $khachHang->MaKH)
                ->where('TrangThai', 'Đã hoàn thành')
                ->sum('TongTien');
        }

        $diaChis = $user->diaChiGiaoHangs()->orderBy('la_mac_dinh', 'desc')->get();

        return view('admin.khach-hang.show', compact('user', 'khachHang', 'donHangs', 'tongChiTieu', 'diaChis'));
    }

    /** Khoá / mở khoá tài khoản */
    public function toggleActive($id)
    {
        $user = User::where('role', 'customer')->findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        $msg = $user->is_active ? 'Đã mở khoá tài khoản!' : 'Đã khoá tài khoản!';
        return redirect()->back()->with('success', $msg);
    }

    /** Xoá khách hàng */
    public function destroy($id)
    {
        $user = User::where('role', 'customer')->findOrFail($id);
        $user->delete();
        return redirect()->route('admin.khach-hang.index')->with('success', 'Đã xoá tài khoản khách hàng!');
    }
}

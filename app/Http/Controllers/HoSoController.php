<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\DiaChiGiaoHang;

/**
 * HoSoController – Trang hồ sơ cá nhân của khách hàng
 */
class HoSoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** Hiển thị trang hồ sơ */
    public function index()
    {
        $user   = Auth::user();
        $diaChis = $user->diaChiGiaoHangs()->orderBy('la_mac_dinh', 'desc')->get();
        return view('ho-so.index', compact('user', 'diaChis'));
    }

    /** Cập nhật thông tin cá nhân */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'          => 'required|string|max:100',
            'so_dien_thoai' => 'nullable|string|max:20',
            'dia_chi'       => 'nullable|string|max:500',
            'phuong_xa'     => 'nullable|string|max:100',
            'quan_huyen'    => 'nullable|string|max:100',
            'tinh_thanh'    => 'nullable|string|max:100',
            'ngay_sinh'     => 'nullable|date',
            'gioi_tinh'     => 'nullable|in:Nam,Nữ,Khác',
        ]);

        $user->update($request->only([
            'name', 'so_dien_thoai', 'dia_chi', 'phuong_xa',
            'quan_huyen', 'tinh_thanh', 'ngay_sinh', 'gioi_tinh',
        ]));

        return redirect()->route('ho-so.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    /** Đổi mật khẩu */
    public function doiMatKhau(Request $request)
    {
        $request->validate([
            'mat_khau_cu'   => 'required',
            'mat_khau_moi'  => 'required|string|min:6|confirmed',
        ], [
            'mat_khau_moi.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->mat_khau_cu, $user->password)) {
            return back()->withErrors(['mat_khau_cu' => 'Mật khẩu hiện tại không đúng.']);
        }

        $user->password = Hash::make($request->mat_khau_moi);
        $user->save();

        return redirect()->route('ho-so.index')->with('success', 'Đổi mật khẩu thành công!');
    }

    // ─── Địa chỉ giao hàng ───────────────────────────────────

    /** Thêm địa chỉ mới */
    public function themDiaChi(Request $request)
    {
        $request->validate([
            'ho_ten'        => 'required|string|max:100',
            'so_dien_thoai' => 'required|string|max:20',
            'dia_chi'       => 'required|string|max:500',
            'phuong_xa'     => 'nullable|string|max:100',
            'quan_huyen'    => 'nullable|string|max:100',
            'tinh_thanh'    => 'required|string|max:100',
        ]);

        $user = Auth::user();

        // Nếu đánh dấu mặc định → bỏ các địa chỉ mặc định cũ
        if ($request->boolean('la_mac_dinh')) {
            $user->diaChiGiaoHangs()->update(['la_mac_dinh' => false]);
        }

        $user->diaChiGiaoHangs()->create(array_merge(
            $request->only(['ho_ten', 'so_dien_thoai', 'dia_chi', 'phuong_xa', 'quan_huyen', 'tinh_thanh']),
            ['la_mac_dinh' => $request->boolean('la_mac_dinh')]
        ));

        return redirect()->route('ho-so.index')->with('success', 'Đã thêm địa chỉ giao hàng!');
    }

    /** Đặt địa chỉ làm mặc định */
    public function setMacDinh($id)
    {
        $user = Auth::user();
        $user->diaChiGiaoHangs()->update(['la_mac_dinh' => false]);
        $user->diaChiGiaoHangs()->where('id', $id)->update(['la_mac_dinh' => true]);
        return redirect()->route('ho-so.index')->with('success', 'Đã đặt địa chỉ mặc định!');
    }

    /** Xoá địa chỉ */
    public function xoaDiaChi($id)
    {
        Auth::user()->diaChiGiaoHangs()->where('id', $id)->delete();
        return redirect()->route('ho-so.index')->with('success', 'Đã xoá địa chỉ!');
    }
}

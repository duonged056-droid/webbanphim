<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $sanpham = SanPham::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        // Kiểm tra tồn kho
        if ($quantity > $sanpham->SoLuongTon) {
            return redirect()->back()->with('error', 'Số lượng sản phẩm trong kho không đủ!');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $sanpham->TenSP,
                'quantity' => $quantity,
                'price' => $sanpham->GiaBan,
                'image' => $sanpham->HinhAnh
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Đã thêm "' . $sanpham->TenSP . '" vào giỏ hàng!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'DienThoai' => ['required', 'string', 'regex:/^[0-9]{9,11}$/'],
            'DiaChiGiaoHang' => 'required|string|max:500',
            'PhuongThucThanhToan' => 'required|string',
        ], [
            'DienThoai.required' => 'Vui lòng nhập số điện thoại.',
            'DienThoai.regex' => 'Số điện thoại chỉ gồm 9-11 chữ số.',
            'DiaChiGiaoHang.required' => 'Vui lòng nhập địa chỉ giao hàng.',
        ]);

        $cart = session()->get('cart', []);
        if (count($cart) == 0) {
            return redirect()->route('home')->with('error', 'Giỏ hàng trống!');
        }

        DB::beginTransaction();
        try {
            // Liên kết với bảng khach_hangs
            $khachHang = DB::table('khach_hangs')->where('Email', Auth::user()->email)->first();
            if (!$khachHang) {
                $khachHangId = DB::table('khach_hangs')->insertGetId([
                    'TenKH' => Auth::user()->name,
                    'Email' => Auth::user()->email,
                    'MatKhau' => 'NO_PASSWORD',
                    'SoDienThoai' => $request->DienThoai,
                    'DiaChi' => $request->DiaChiGiaoHang,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $khachHangId = $khachHang->MaKH;
            }

            $total = 0;
            foreach($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $hoadon = HoaDon::create([
                'MaKH' => $khachHangId,
                'NgayDat' => now(),
                'TongTien' => $total,
                'TrangThai' => 'Đang xử lý',
                'DienThoai' => $request->DienThoai,
                'DiaChiGiaoHang' => $request->DiaChiGiaoHang,
                'PhuongThucThanhToan' => $request->PhuongThucThanhToan,
            ]);

            foreach ($cart as $id => $item) {
                ChiTietHoaDon::create([
                    'MaHD' => $hoadon->MaHD,
                    'MaSP' => $id,
                    'SoLuong' => $item['quantity'],
                    'DonGia' => $item['price'],
                ]);
                
                // Trừ tồn kho
                $sp = SanPham::lockForUpdate()->find($id);
                if ($sp) {
                    $sp->SoLuongTon -= $item['quantity'];
                    $sp->save();
                }
            }

            DB::commit();
            session()->forget('cart');
            return redirect()->route('home')->with('success', 'Đặt hàng thành công! Đơn hàng của bạn đang được xử lý.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;

class BuildController extends Controller
{
    public function index()
    {
        $kits = SanPham::where('LoaiSP', 'Bàn phím cơ')->where('SoLuongTon', '>', 0)->get();
        $switches = SanPham::where('LoaiSP', 'Switch')->where('SoLuongTon', '>', 0)->get();
        $keycaps = SanPham::where('LoaiSP', 'Keycap')->where('SoLuongTon', '>', 0)->get();

        return view('build.index', compact('kits', 'switches', 'keycaps'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'kit_id' => 'required|exists:san_phams,MaSP',
            'switch_id' => 'required|exists:san_phams,MaSP',
            'keycap_id' => 'required|exists:san_phams,MaSP',
        ]);

        $ids = [$request->kit_id, $request->switch_id, $request->keycap_id];
        $cart = session()->get('cart', []);

        foreach ($ids as $id) {
            $product = SanPham::find($id);
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "name" => $product->TenSP,
                    "quantity" => 1,
                    "price" => $product->GiaBan,
                    "image" => $product->HinhAnh
                ];
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Đã thêm combo Build Bàn Phím vào giỏ hàng!');
    }
}

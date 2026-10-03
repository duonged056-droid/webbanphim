<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Dành cho Khách hàng
    public function index()
    {
        $khachHang = DB::table('khach_hangs')->where('Email', Auth::user()->email)->first();
        if (!$khachHang) {
            $orders = collect(); // Chưa mua gì
        } else {
            $orders = HoaDon::where('MaKH', $khachHang->MaKH)
                            ->orderBy('NgayDat', 'desc')
                            ->get();
        }
        
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $khachHang = DB::table('khach_hangs')->where('Email', Auth::user()->email)->first();
        if (!$khachHang) abort(404);

        $order = HoaDon::where('MaHD', $id)->where('MaKH', $khachHang->MaKH)->firstOrFail();
        
        $details = DB::table('chi_tiet_hoa_dons')
                    ->join('san_phams', 'chi_tiet_hoa_dons.MaSP', '=', 'san_phams.MaSP')
                    ->where('chi_tiet_hoa_dons.MaHD', $id)
                    ->select('chi_tiet_hoa_dons.*', 'san_phams.TenSP', 'san_phams.HinhAnh')
                    ->get();
                    
        return view('orders.show', compact('order', 'details'));
    }

    // Dành cho Admin
    public function adminIndex()
    {
        $orders = HoaDon::select('hoa_dons.*', 'khach_hangs.TenKH as TenKhachHang', 'khach_hangs.Email')
                        ->leftJoin('khach_hangs', 'hoa_dons.MaKH', '=', 'khach_hangs.MaKH')
                        ->orderBy('NgayDat', 'desc')
                        ->paginate(20);
                        
        return view('admin.orders.index', compact('orders'));
    }

    public function adminShow($id)
    {
        $order = HoaDon::select('hoa_dons.*', 'khach_hangs.TenKH as TenKhachHang', 'khach_hangs.Email')
                        ->leftJoin('khach_hangs', 'hoa_dons.MaKH', '=', 'khach_hangs.MaKH')
                        ->where('MaHD', $id)
                        ->firstOrFail();

        $details = DB::table('chi_tiet_hoa_dons')
                    ->join('san_phams', 'chi_tiet_hoa_dons.MaSP', '=', 'san_phams.MaSP')
                    ->where('chi_tiet_hoa_dons.MaHD', $id)
                    ->select('chi_tiet_hoa_dons.*', 'san_phams.TenSP', 'san_phams.HinhAnh')
                    ->get();
                    
        return view('admin.orders.show', compact('order', 'details'));
    }

    public function markAsCompleted($id)
    {
        $khachHang = DB::table('khach_hangs')->where('Email', Auth::user()->email)->first();
        if (!$khachHang) abort(404);

        $order = HoaDon::where('MaHD', $id)->where('MaKH', $khachHang->MaKH)->firstOrFail();
        if ($order->TrangThai !== 'Đã hoàn thành') {
            $order->TrangThai = 'Đã hoàn thành';
            $order->save();
        }

        return redirect()->back()->with('success', 'Đã xác nhận hoàn thành đơn hàng!');
    }

    public function adminMarkAsCompleted($id)
    {
        $order = HoaDon::findOrFail($id);
        if ($order->TrangThai !== 'Đã hoàn thành') {
            $order->TrangThai = 'Đã hoàn thành';
            $order->save();
        }

        return redirect()->back()->with('success', 'Đã đánh dấu đơn hàng là Đã hoàn thành!');
    }
}

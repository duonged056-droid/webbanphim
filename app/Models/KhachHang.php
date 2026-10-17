<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;

    protected $table = 'khach_hangs';
    protected $primaryKey = 'MaKH';

    protected $fillable = [
        'TenKH',
        'Email',
        'MatKhau',
        'SoDienThoai',
        'DiaChi',
    ];

    protected $hidden = ['MatKhau'];

    /** Khách hàng có nhiều hoá đơn */
    public function hoaDons()
    {
        return $this->hasMany(HoaDon::class, 'MaKH', 'MaKH');
    }

    /** Tổng số đơn hàng */
    public function getTongDonHangAttribute()
    {
        return $this->hoaDons()->count();
    }

    /** Tổng chi tiêu */
    public function getTongChiTieuAttribute()
    {
        return $this->hoaDons()->where('TrangThai', 'Đã hoàn thành')->sum('TongTien');
    }
}

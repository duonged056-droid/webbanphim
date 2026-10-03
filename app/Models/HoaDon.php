<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;

    protected $table = 'hoa_dons';
    protected $primaryKey = 'MaHD';

    protected $fillable = [
        'MaKH',
        'NgayDat',
        'TongTien',
        'TrangThai',
        'DienThoai',
        'DiaChiGiaoHang',
        'PhuongThucThanhToan'
    ];
}

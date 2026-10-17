<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $table = 'san_phams';
    protected $primaryKey = 'MaSP';

    protected $fillable = [
        'TenSP',
        'LoaiSP',
        'GiaBan',
        'SoLuongTon',
        'MoTa',
        'HinhAnh'
    ];

    /** Các đánh giá của sản phẩm */
    public function danhGias()
    {
        return $this->hasMany(DanhGia::class, 'MaSP', 'MaSP');
    }

    /** Các đánh giá đã được duyệt */
    public function danhGiaDaDuyet()
    {
        return $this->hasMany(DanhGia::class, 'MaSP', 'MaSP')->where('da_duyet', true);
    }

    /** Điểm đánh giá trung bình */
    public function getDiemTrungBinhAttribute(): float
    {
        return (float) ($this->danhGiaDaDuyet()->avg('so_sao') ?? 5.0);
    }

    /** Tổng số đánh giá đã duyệt */
    public function getTongDanhGiaAttribute(): int
    {
        return $this->danhGiaDaDuyet()->count();
    }
}

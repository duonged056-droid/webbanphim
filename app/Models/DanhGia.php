<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;

    protected $table = 'danh_gias';

    protected $fillable = [
        'user_id',
        'MaSP',
        'MaHD',
        'so_sao',
        'tieu_de',
        'noi_dung',
        'da_duyet',
    ];

    protected $casts = [
        'da_duyet' => 'boolean',
        'so_sao'   => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSP', 'MaSP');
    }

    public function hoaDon()
    {
        return $this->belongsTo(HoaDon::class, 'MaHD', 'MaHD');
    }

    /** Chỉ lấy đánh giá đã được duyệt */
    public function scopeDaDuyet($query)
    {
        return $query->where('da_duyet', true);
    }
}

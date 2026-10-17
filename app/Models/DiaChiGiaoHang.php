<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaChiGiaoHang extends Model
{
    use HasFactory;

    protected $table = 'dia_chi_giao_hangs';

    protected $fillable = [
        'user_id',
        'ho_ten',
        'so_dien_thoai',
        'dia_chi',
        'phuong_xa',
        'quan_huyen',
        'tinh_thanh',
        'la_mac_dinh',
    ];

    protected $casts = [
        'la_mac_dinh' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** Địa chỉ đầy đủ */
    public function getDiaChiDayDuAttribute(): string
    {
        return implode(', ', array_filter([
            $this->dia_chi,
            $this->phuong_xa,
            $this->quan_huyen,
            $this->tinh_thanh,
        ]));
    }
}

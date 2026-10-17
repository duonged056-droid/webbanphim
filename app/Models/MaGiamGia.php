<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaGiamGia extends Model
{
    use HasFactory;

    protected $table = 'ma_giam_gias';

    protected $fillable = [
        'ma_code',
        'mo_ta',
        'loai_giam',
        'gia_tri',
        'don_hang_toi_thieu',
        'giam_toi_da',
        'so_luong_su_dung',
        'gioi_han_su_dung',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'is_active',
    ];

    protected $casts = [
        'ngay_bat_dau'     => 'datetime',
        'ngay_ket_thuc'    => 'datetime',
        'is_active'        => 'boolean',
        'gia_tri'          => 'float',
        'don_hang_toi_thieu' => 'float',
        'giam_toi_da'      => 'float',
    ];

    /** Kiểm tra mã còn hiệu lực */
    public function conHieuLuc(): bool
    {
        $now = now();
        $conHan = $now->between($this->ngay_bat_dau, $this->ngay_ket_thuc);
        $conLuot = is_null($this->gioi_han_su_dung) || $this->so_luong_su_dung < $this->gioi_han_su_dung;
        return $this->is_active && $conHan && $conLuot;
    }

    /** Tính số tiền giảm cho đơn hàng */
    public function tinhGiam(float $tongTien): float
    {
        if ($tongTien < $this->don_hang_toi_thieu) return 0;
        if ($this->loai_giam === 'phan_tram') {
            $giam = $tongTien * ($this->gia_tri / 100);
            return $this->giam_toi_da ? min($giam, $this->giam_toi_da) : $giam;
        }
        return min($this->gia_tri, $tongTien);
    }
}

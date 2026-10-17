<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'so_dien_thoai',
        'dia_chi',
        'phuong_xa',
        'quan_huyen',
        'tinh_thanh',
        'avatar',
        'ngay_sinh',
        'gioi_tinh',
        'is_active',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'ngay_sinh'         => 'date',
        'last_login_at'     => 'datetime',
        'is_active'         => 'boolean',
    ];

    // ─── Relationships ───────────────────────────────────────

    /** Nhiều địa chỉ giao hàng */
    public function diaChiGiaoHangs()
    {
        return $this->hasMany(DiaChiGiaoHang::class, 'user_id');
    }

    /** Địa chỉ mặc định */
    public function diaChiMacDinh()
    {
        return $this->hasOne(DiaChiGiaoHang::class, 'user_id')->where('la_mac_dinh', true);
    }

    /** Các đánh giá của người dùng */
    public function danhGias()
    {
        return $this->hasMany(DanhGia::class, 'user_id');
    }

    // ─── Helpers ─────────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }
}

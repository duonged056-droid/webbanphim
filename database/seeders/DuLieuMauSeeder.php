<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DiaChiGiaoHang;
use App\Models\MaGiamGia;
use App\Models\DanhGia;
use App\Models\SanPham;

class DuLieuMauSeeder extends Seeder
{
    public function run()
    {
        // 1. Cập nhật thông tin chi tiết cho tài khoản khách hàng
        $userDuong = User::where('email', 'duonghoang130226@gmail.com')->first();
        if ($userDuong) {
            $userDuong->update([
                'so_dien_thoai' => '0987654321',
                'dia_chi'       => '123 Nguyễn Huệ',
                'phuong_xa'     => 'Phường Bến Nghé',
                'quan_huyen'    => 'Quận 1',
                'tinh_thanh'    => 'TP. Hồ Chí Minh',
                'ngay_sinh'     => '2000-02-26',
                'gioi_tinh'     => 'Nam',
                'is_active'     => true,
            ]);

            // Thêm sổ địa chỉ nếu chưa có
            if ($userDuong->diaChiGiaoHangs()->count() === 0) {
                DiaChiGiaoHang::create([
                    'user_id'       => $userDuong->id,
                    'ho_ten'        => 'Hoàng Văn Đương',
                    'so_dien_thoai' => '0987654321',
                    'dia_chi'       => '123 Nguyễn Huệ',
                    'phuong_xa'     => 'Phường Bến Nghé',
                    'quan_huyen'    => 'Quận 1',
                    'tinh_thanh'    => 'TP. Hồ Chí Minh',
                    'la_mac_dinh'   => true,
                ]);

                DiaChiGiaoHang::create([
                    'user_id'       => $userDuong->id,
                    'ho_ten'        => 'Hoàng Văn Đương (Văn phòng)',
                    'so_dien_thoai' => '0987654321',
                    'dia_chi'       => 'Tòa nhà Landmark 81, 720A Điện Biên Phủ',
                    'phuong_xa'     => 'Phường 22',
                    'quan_huyen'    => 'Quận Bình Thạnh',
                    'tinh_thanh'    => 'TP. Hồ Chí Minh',
                    'la_mac_dinh'   => false,
                ]);
            }
        }

        $userKhach = User::where('email', 'khach@gmail.com')->first();
        if ($userKhach) {
            $userKhach->update([
                'so_dien_thoai' => '0912345678',
                'dia_chi'       => '456 Lê Lợi',
                'phuong_xa'     => 'Phường Bến Thành',
                'quan_huyen'    => 'Quận 1',
                'tinh_thanh'    => 'TP. Hồ Chí Minh',
                'ngay_sinh'     => '1998-05-15',
                'gioi_tinh'     => 'Nam',
                'is_active'     => true,
            ]);

            if ($userKhach->diaChiGiaoHangs()->count() === 0) {
                DiaChiGiaoHang::create([
                    'user_id'       => $userKhach->id,
                    'ho_ten'        => 'Khách Mua Phím',
                    'so_dien_thoai' => '0912345678',
                    'dia_chi'       => '456 Lê Lợi',
                    'phuong_xa'     => 'Phường Bến Thành',
                    'quan_huyen'    => 'Quận 1',
                    'tinh_thanh'    => 'TP. Hồ Chí Minh',
                    'la_mac_dinh'   => true,
                ]);
            }
        }

        // 2. Tạo các Mã giảm giá chuẩn cho shop phím cơ
        $coupons = [
            [
                'ma_code'            => 'KEYLABS10',
                'mo_ta'              => 'Giảm 10% cho đơn hàng đầu tiên (tối đa 200.000đ)',
                'loai_giam'          => 'phan_tram',
                'gia_tri'            => 10,
                'don_hang_toi_thieu' => 500000,
                'giam_toi_da'        => 200000,
                'gioi_han_su_dung'   => 100,
                'ngay_bat_dau'       => now()->subDays(5),
                'ngay_ket_thuc'      => now()->addMonths(3),
                'is_active'          => true,
            ],
            [
                'ma_code'            => 'FREESHIP50K',
                'mo_ta'              => 'Giảm ngay 50.000đ tiền vận chuyển cho đơn từ 300.000đ',
                'loai_giam'          => 'so_tien',
                'gia_tri'            => 50000,
                'don_hang_toi_thieu' => 300000,
                'giam_toi_da'        => null,
                'gioi_han_su_dung'   => 500,
                'ngay_bat_dau'       => now()->subDays(1),
                'ngay_ket_thuc'      => now()->addMonths(6),
                'is_active'          => true,
            ],
            [
                'ma_code'            => 'CUSTOMPRO',
                'mo_ta'              => 'Giảm 15% tối đa 500.000đ cho bàn phím Custom cao cấp',
                'loai_giam'          => 'phan_tram',
                'gia_tri'            => 15,
                'don_hang_toi_thieu' => 1500000,
                'giam_toi_da'        => 500000,
                'gioi_han_su_dung'   => 50,
                'ngay_bat_dau'       => now(),
                'ngay_ket_thuc'      => now()->addMonths(2),
                'is_active'          => true,
            ],
        ];

        foreach ($coupons as $c) {
            MaGiamGia::firstOrCreate(['ma_code' => $c['ma_code']], $c);
        }

        // 3. Tạo đánh giá mẫu cho sản phẩm
        $sanPhams = SanPham::take(5)->get();
        $sampleUserId = $userDuong ? $userDuong->id : ($userKhach ? $userKhach->id : 1);

        $reviews = [
            [
                'so_sao'   => 5,
                'tieu_de'  => 'Gõ cực kỳ đầm tay, âm thock rất sướng!',
                'noi_dung' => 'Bàn phím hoàn thiện xuất sắc, switch đã được pre-lube sẵn rất mượt, không hề có tiếng vang lò xo. Đèn RGB cực kỳ bắt mắt, xứng đáng từng đồng.',
            ],
            [
                'so_sao'   => 5,
                'tieu_de'  => 'Kết nối không dây 3 chế độ siêu ổn định',
                'noi_dung' => 'Dùng Type-C, Bluetooth và 2.4Ghz chuyển đổi rất mượt. Pin trâu dùng cả tuần chưa phải sạc lại. Rất hài lòng với dịch vụ tư vấn của shop.',
            ],
            [
                'so_sao'   => 4,
                'tieu_de'  => 'Keycap PBT dày dặn, layout gọn gàng',
                'noi_dung' => 'Chất lượng nhựa PBT double-shot nhám nhẹ chống bám vân tay tốt. Giao hàng bọc chống sốc 3 lớp cẩn thận, cho 9.5/10 điểm.',
            ],
        ];

        foreach ($sanPhams as $idx => $sp) {
            $r = $reviews[$idx % count($reviews)];
            DanhGia::firstOrCreate(
                [
                    'user_id' => $sampleUserId,
                    'MaSP'    => $sp->MaSP,
                ],
                [
                    'so_sao'   => $r['so_sao'],
                    'tieu_de'  => $r['tieu_de'],
                    'noi_dung' => $r['noi_dung'],
                    'da_duyet' => true,
                ]
            );
        }
    }
}

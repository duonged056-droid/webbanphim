<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SanPhamSeeder extends Seeder
{
    public function run()
    {
        $brands = ['Keychron', 'Akko', 'Razer', 'Corsair', 'Logitech', 'Leopold', 'Filco', 'Varmilo', 'Ducky', 'RK', 'MonsGeek', 'Cidoo'];
        $switches = ['Cherry MX Red', 'Cherry MX Blue', 'Cherry MX Brown', 'Gateron Yellow', 'Gateron Black Ink', 'Kailh Box White', 'Akko CS Jelly Pink', 'Holy Panda', 'TTC Gold Pink', 'Zaku', 'Boba U4T'];
        $keycaps = ['GMK', 'SA', 'Cherry', 'OEM', 'XDA', 'MDA'];
        $themes = ['Midnight', 'Olivia', 'Botanical', 'Darling', 'Laser', 'Samurai', 'Minimal', 'Apollo', 'Bento', 'Nautilus'];
        
        $data = [];

        // Generate 40 Keyboards
        for ($i = 1; $i <= 40; $i++) {
            $brand = $brands[array_rand($brands)];
            $data[] = [
                'TenSP' => 'Bàn phím cơ ' . $brand . ' Model ' . rand(100, 9999),
                'LoaiSP' => 'Bàn phím cơ',
                'GiaBan' => rand(8, 50) * 100000,
                'SoLuongTon' => rand(10, 100),
                'MoTa' => 'Bàn phím cơ cao cấp chính hãng từ ' . $brand . ', phù hợp cho cả chơi game và làm việc. Thiết kế cứng cáp, bền bỉ.',
                'HinhAnh' => rand(0, 1) == 0 ? 'keychron.jpg' : 'akko.jpg',
            ];
        }

        // Generate 30 Switches
        for ($i = 1; $i <= 30; $i++) {
            $sw = $switches[array_rand($switches)];
            $data[] = [
                'TenSP' => 'Switch ' . $sw . ' V' . rand(1, 3) . ' (Pack 90 viên)',
                'LoaiSP' => 'Switch',
                'GiaBan' => rand(3, 15) * 100000,
                'SoLuongTon' => rand(50, 500),
                'MoTa' => 'Bộ switch ' . $sw . ' cực mượt, âm thanh gõ đã tai, độ bền 50 triệu lần nhấn.',
                'HinhAnh' => 'cherry.jpg',
            ];
        }

        // Generate 30 Keycaps
        for ($i = 1; $i <= 30; $i++) {
            $kc = $keycaps[array_rand($keycaps)];
            $theme = $themes[array_rand($themes)];
            $data[] = [
                'TenSP' => 'Bộ Keycap ' . $kc . ' Profile chủ đề ' . $theme,
                'LoaiSP' => 'Keycap',
                'GiaBan' => rand(5, 30) * 100000,
                'SoLuongTon' => rand(5, 50),
                'MoTa' => 'Keycap chất liệu nhựa PBT/ABS dập nổi 2 lớp (Doubleshot), chống bám mồ hôi, không bao giờ mờ chữ.',
                'HinhAnh' => 'akko.jpg',
            ];
        }

        // Chia nhỏ insert thành các batch để tránh lỗi payload quá lớn
        $chunks = array_chunk($data, 20);
        foreach ($chunks as $chunk) {
            DB::table('san_phams')->insert($chunk);
        }
    }
}

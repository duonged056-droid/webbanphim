<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Delete all fake generated products (ID > 5)
DB::table('san_phams')->where('MaSP', '>', 5)->delete();

$realProducts = [
    [
        'TenSP' => 'Bàn phím cơ Aula F75',
        'HinhAnh' => 'https://cdn-files.hacom.vn/hacom/cdn/web/24082026/ban-phim-co-gaming-aula-hero75he-3-mode-mau-cam-trang-spiritcloud-magnetic-switch.jpg',
        'LoaiSP' => 'Bàn phím cơ',
        'GiaBan' => 950000,
    ],
    [
        'TenSP' => 'Bàn phím cơ Nut75',
        'HinhAnh' => 'https://hanoicomputercdn.com/media/product/76324_ban_phim_gaming_khong_day_logitech_pro_x_tkl_lightspeed_mau_trang_tactile_switch___920_012149_1.jpg',
        'LoaiSP' => 'Bàn phím cơ',
        'GiaBan' => 1250000,
    ],
    [
        'TenSP' => 'Bàn phím ASUS ROG Azoth Extreme Edition 20 (ROG NX Snow)',
        'HinhAnh' => 'https://cdn-files.hacom.vn/hacom/cdn/web/12062026/ban-phim-asus-rog-azoth-extreme-edition-20-rog-nx-snow-1.jpg',
        'LoaiSP' => 'Bàn phím cơ',
        'GiaBan' => 5990000,
    ],
    [
        'TenSP' => 'Bàn phím Razer Huntsman V3 Pro Tenkeyless',
        'HinhAnh' => 'https://cdn-files.hacom.vn/hacom/cdn/web/14092026/ban-phim-razer-huntsman-v3-pro-tenkeyless-8khz-sentinels-edition-rz03-05521700-r3m1-1.jpg',
        'LoaiSP' => 'Bàn phím cơ',
        'GiaBan' => 4500000,
    ],
    [
        'TenSP' => 'Bàn phím Corsair GALLEON 100 SD-BLK',
        'HinhAnh' => 'https://cdn-files.hacom.vn/hacom/cdn/web/05022026/ban-phim-corsair-galleon-100-sd-blk-mlx-pulse.jpg',
        'LoaiSP' => 'Bàn phím cơ',
        'GiaBan' => 2100000,
    ],
    [
        'TenSP' => 'Bàn phím Logitech G512 X 75 Màu Đen',
        'HinhAnh' => 'https://cdn-files.hacom.vn/hacom/cdn/web/26052026/ban-phim-logitech-g512-x-75-mau-den-1.jpg',
        'LoaiSP' => 'Bàn phím cơ',
        'GiaBan' => 1890000,
    ],
    [
        'TenSP' => 'Bàn phím Keychron Q6U-M1 Red Switch',
        'HinhAnh' => 'https://cdn-files.hacom.vn/hacom/cdn/web/25042026/ban-phim-keychron-q6u-m1-red-switch.jpg',
        'LoaiSP' => 'Bàn phím cơ',
        'GiaBan' => 3800000,
    ],
    [
        'TenSP' => 'Bàn phím cơ Logitech G413 SE TKL',
        'HinhAnh' => 'https://hanoicomputercdn.com/media/product/63508_ban_phim_co_logitech_g413_se_tkl_tactile_sw_usb_pbt_0002_3.jpg',
        'LoaiSP' => 'Bàn phím cơ',
        'GiaBan' => 1590000,
    ],
    [
        'TenSP' => 'Bàn phím Razer BlackWidow V3 Green switch',
        'HinhAnh' => 'https://hanoicomputercdn.com/media/product/56226_ba_n_phi_m_razer_blackwidow_v3_rz03_03540100_r3m1_0002_3.jpg',
        'LoaiSP' => 'Bàn phím cơ',
        'GiaBan' => 2990000,
    ],
    [
        'TenSP' => 'Bàn phím cơ gaming Edra EK398 Alpha',
        'HinhAnh' => 'https://hanoicomputercdn.com/media/product/71045_ban_phim_co_gaming_edra_ek398_alpha_blue_switch_usb_abs_led_rainbow_1.jpg',
        'LoaiSP' => 'Bàn phím cơ',
        'GiaBan' => 690000,
    ],
    // Switches
    [
        'TenSP' => 'Switch Cherry MX Red (Pack 90)',
        'HinhAnh' => 'cherry.jpg',
        'LoaiSP' => 'Switch',
        'GiaBan' => 850000,
    ],
    [
        'TenSP' => 'Switch Gateron Milky Yellow Pro (Pack 90)',
        'HinhAnh' => 'cherry.jpg',
        'LoaiSP' => 'Switch',
        'GiaBan' => 650000,
    ],
    // Keycaps
    [
        'TenSP' => 'Bộ Keycap CMK Trắng Xanh',
        'HinhAnh' => 'akko.jpg',
        'LoaiSP' => 'Keycap',
        'GiaBan' => 500000,
    ],
    [
        'TenSP' => 'Bộ Keycap GMK Olivia Clone',
        'HinhAnh' => 'akko.jpg',
        'LoaiSP' => 'Keycap',
        'GiaBan' => 450000,
    ]
];

$data = [];
foreach ($realProducts as $p) {
    $data[] = [
        'TenSP' => $p['TenSP'],
        'LoaiSP' => $p['LoaiSP'],
        'GiaBan' => $p['GiaBan'],
        'SoLuongTon' => rand(10, 50),
        'MoTa' => 'Sản phẩm chính hãng, phân phối trực tiếp tại KeebShop.',
        'HinhAnh' => $p['HinhAnh'],
    ];
}

DB::table('san_phams')->insert($data);
echo "Inserted " . count($realProducts) . " REAL products with REAL images!\n";

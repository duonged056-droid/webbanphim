<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$products = DB::table('san_phams')->where('MaSP', '>', 5)->get();

// Define image mappings based on keywords
$images = [
    'Keychron' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?q=80&w=600&auto=format&fit=crop',
    'Razer' => 'https://images.unsplash.com/photo-1595044426077-d36d9236d57a?q=80&w=600&auto=format&fit=crop',
    'Logitech' => 'https://images.unsplash.com/photo-1541140532154-b024d705b909?q=80&w=600&auto=format&fit=crop',
    'Corsair' => 'https://images.unsplash.com/photo-1625842268584-8f3296236761?q=80&w=600&auto=format&fit=crop',
    'Akko' => 'akko.jpg', // Dùng ảnh xịn đã generate
    'Leopold' => 'https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?q=80&w=600&auto=format&fit=crop',
    'Filco' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?q=80&w=600&auto=format&fit=crop',
    'RK' => 'https://images.unsplash.com/photo-1606148332560-6479f64c1da5?q=80&w=600&auto=format&fit=crop',
    'Varmilo' => 'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?q=80&w=600&auto=format&fit=crop',
    'Ducky' => 'https://images.unsplash.com/photo-1555680202-c86f0e12f086?q=80&w=600&auto=format&fit=crop',
    
    // Default cho Switch và Keycap
    'Switch' => 'cherry.jpg',
    'Keycap' => 'https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?q=80&w=600&auto=format&fit=crop',
];

$count = 0;
foreach ($products as $sp) {
    $matched_img = 'https://images.unsplash.com/photo-1595225476474-87563907a212?q=80&w=600&auto=format&fit=crop'; // Default
    
    foreach ($images as $keyword => $url) {
        if (stripos($sp->TenSP, $keyword) !== false) {
            $matched_img = $url;
            break;
        }
    }
    
    DB::table('san_phams')->where('MaSP', $sp->MaSP)->update([
        'HinhAnh' => $matched_img
    ]);
    $count++;
}
echo "Updated images for " . $count . " products to match their models.\n";

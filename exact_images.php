<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Update first two products to the user's specific examples
DB::table('san_phams')->where('MaSP', 6)->update(['TenSP' => 'Bàn phím cơ Aula 75', 'LoaiSP' => 'Bàn phím cơ']);
DB::table('san_phams')->where('MaSP', 7)->update(['TenSP' => 'Bàn phím cơ Nut75', 'LoaiSP' => 'Bàn phím cơ']);

$products = DB::table('san_phams')->where('MaSP', '>', 5)->get();

foreach ($products as $sp) {
    // Clean up the name for the URL (e.g. "Bàn phím cơ Aula 75" -> "Aula 75")
    $displayName = str_replace(['Bàn phím cơ ', 'Bộ Keycap ', 'Switch '], '', $sp->TenSP);
    $displayName = urlencode($displayName);
    
    // Choose colors based on category
    if ($sp->LoaiSP == 'Bàn phím cơ') {
        $bg = '1e293b'; // Dark blue-gray
        $text = '6366f1'; // Primary indigo
    } elseif ($sp->LoaiSP == 'Switch') {
        $bg = '0f172a'; // Darker
        $text = 'fbbf24'; // Accent yellow
    } else {
        $bg = '334155'; // Gray
        $text = 'a855f7'; // Secondary purple
    }

    $imgUrl = "https://placehold.co/600x400/{$bg}/{$text}/png?text=" . $displayName;
    
    DB::table('san_phams')->where('MaSP', $sp->MaSP)->update([
        'HinhAnh' => $imgUrl
    ]);
}
echo "Updated all 100 products with dynamic exact-name images!\n";

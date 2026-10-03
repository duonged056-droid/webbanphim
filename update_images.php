<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$products = DB::table('san_phams')->where('MaSP', '>', 5)->get();
foreach ($products as $sp) {
    DB::table('san_phams')->where('MaSP', $sp->MaSP)->update([
        'HinhAnh' => 'https://picsum.photos/seed/' . $sp->MaSP . '/400/400'
    ]);
}
echo "Updated " . count($products) . " products.\n";

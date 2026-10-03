<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckoutFieldsToHoaDonsTable extends Migration
{
    public function up()
    {
        Schema::table('hoa_dons', function (Blueprint $table) {
            $table->string('DienThoai', 20)->nullable();
            $table->string('DiaChiGiaoHang', 255)->nullable();
            $table->string('PhuongThucThanhToan', 50)->nullable();
        });
    }

    public function down()
    {
        Schema::table('hoa_dons', function (Blueprint $table) {
            $table->dropColumn(['DienThoai', 'DiaChiGiaoHang', 'PhuongThucThanhToan']);
        });
    }
}

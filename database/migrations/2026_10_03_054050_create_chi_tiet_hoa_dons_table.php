<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietHoaDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_hoa_dons', function (Blueprint $table) {
            $table->unsignedBigInteger('MaHD');
            $table->unsignedBigInteger('MaSP');
            $table->integer('SoLuong')->default(1);
            $table->decimal('DonGia', 18, 2);
            $table->timestamps();

            $table->primary(['MaHD', 'MaSP']);
            $table->foreign('MaHD')->references('MaHD')->on('hoa_dons')->onDelete('cascade');
            $table->foreign('MaSP')->references('MaSP')->on('san_phams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chi_tiet_hoa_dons');
    }
}

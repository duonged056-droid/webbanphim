<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaGiamGiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ma_giam_gias', function (Blueprint $table) {
            $table->id();
            $table->string('ma_code', 50)->unique();        // Mã code: VD KEYBOARD10
            $table->string('mo_ta', 255)->nullable();       // Mô tả
            $table->enum('loai_giam', ['phan_tram', 'so_tien']); // % hoặc tiền mặt
            $table->decimal('gia_tri', 10, 2);              // Giá trị giảm
            $table->decimal('don_hang_toi_thieu', 18, 2)->default(0); // Đơn tối thiểu
            $table->decimal('giam_toi_da', 18, 2)->nullable(); // Giảm tối đa (cho loại %)
            $table->integer('so_luong_su_dung')->default(0);    // Đã dùng
            $table->integer('gioi_han_su_dung')->nullable();    // Giới hạn dùng (null = vô hạn)
            $table->dateTime('ngay_bat_dau');
            $table->dateTime('ngay_ket_thuc');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ma_giam_gias');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaChiGiaoHangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_chi_giao_hangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Liên kết với bảng users
            $table->string('ho_ten', 100);         // Họ tên người nhận
            $table->string('so_dien_thoai', 20);   // SĐT người nhận
            $table->string('dia_chi', 500);        // Số nhà, đường
            $table->string('phuong_xa', 100)->nullable();
            $table->string('quan_huyen', 100)->nullable();
            $table->string('tinh_thanh', 100);
            $table->boolean('la_mac_dinh')->default(false); // Địa chỉ mặc định
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dia_chi_giao_hangs');
    }
}

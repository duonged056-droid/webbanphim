<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanhGiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danh_gias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');           // Người đánh giá
            $table->unsignedBigInteger('MaSP');              // Sản phẩm được đánh giá
            $table->unsignedBigInteger('MaHD')->nullable();  // Đơn hàng liên quan
            $table->tinyInteger('so_sao');                   // 1-5 sao
            $table->string('tieu_de', 200)->nullable();      // Tiêu đề đánh giá
            $table->text('noi_dung')->nullable();            // Nội dung đánh giá
            $table->boolean('da_duyet')->default(false);     // Admin duyệt
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('MaSP')->references('MaSP')->on('san_phams')->onDelete('cascade');
            $table->foreign('MaHD')->references('MaHD')->on('hoa_dons')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('danh_gias');
    }
}

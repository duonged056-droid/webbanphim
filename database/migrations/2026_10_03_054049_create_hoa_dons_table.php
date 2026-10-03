<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoaDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoa_dons', function (Blueprint $table) {
            $table->id('MaHD');
            $table->unsignedBigInteger('MaKH');
            $table->dateTime('NgayDat');
            $table->decimal('TongTien', 18, 2)->default(0);
            $table->string('TrangThai', 50)->default('Chờ xử lý');
            $table->timestamps();

            $table->foreign('MaKH')->references('MaKH')->on('khach_hangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoa_dons');
    }
}

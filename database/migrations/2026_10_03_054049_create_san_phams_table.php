<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id('MaSP');
            $table->string('TenSP', 200);
            $table->string('LoaiSP', 50);
            $table->decimal('GiaBan', 18, 2);
            $table->integer('SoLuongTon')->default(0);
            $table->text('MoTa')->nullable();
            $table->string('HinhAnh', 255)->nullable();
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
        Schema::dropIfExists('san_phams');
    }
}

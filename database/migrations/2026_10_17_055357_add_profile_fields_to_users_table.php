<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('so_dien_thoai', 20)->nullable()->after('email');
            $table->string('dia_chi', 500)->nullable()->after('so_dien_thoai');
            $table->string('phuong_xa', 100)->nullable()->after('dia_chi');
            $table->string('quan_huyen', 100)->nullable()->after('phuong_xa');
            $table->string('tinh_thanh', 100)->nullable()->after('quan_huyen');
            $table->string('avatar', 255)->nullable()->after('tinh_thanh');
            $table->date('ngay_sinh')->nullable()->after('avatar');
            $table->enum('gioi_tinh', ['Nam', 'Nữ', 'Khác'])->nullable()->after('ngay_sinh');
            $table->boolean('is_active')->default(true)->after('gioi_tinh');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'so_dien_thoai', 'dia_chi', 'phuong_xa', 'quan_huyen',
                'tinh_thanh', 'avatar', 'ngay_sinh', 'gioi_tinh',
                'is_active', 'last_login_at'
            ]);
        });
    }
}

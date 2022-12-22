<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_nhaps', function (Blueprint $table) {
            $table->id('MaPhieuNhap');
            $table->foreignId('MaDauSach')->references('MaDauSach')->on('dau_saches')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('MaNCC')->references('MaNCC')->on('nha_cung_caps')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('NguoiNhap');
            $table->unsignedBigInteger('SoLuong');
            $table->timestampsTz(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieu_nhaps');
    }
};

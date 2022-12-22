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
        Schema::create('dau_saches', function (Blueprint $table) {
            $table->id('MaDauSach');
            $table->string('TenSach');
            $table->string('TacGia');
            $table->foreignId('MaTL')->references('MaTL')->on('the_loais')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('MaPL')->references('MaPL')->on('phan_loais')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('NhaXuatBan');
            $table->year('NamXuatBan');
            $table->foreignId('MaNN')->references('MaNN')->on('ngon_ngus')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('Gia');
            $table->string('GhiChu')->nullable();
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
        Schema::dropIfExists('dau_saches');
    }
};

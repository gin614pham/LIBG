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
        Schema::create('saches', function (Blueprint $table) {
            $table->id('MaSach');
            $table->foreignId('MaDauSach')->references('MaDauSach')->on('dau_saches')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->enum('TinhTrang', ['Chuẩn bị', 'Sẵn sàng', 'Bận']);
            $table->string('NguoiCN')->nullable();
            $table->boolean('ThanhLy')->default(false);
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
        Schema::dropIfExists('saches');
    }
};

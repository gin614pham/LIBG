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
        Schema::create('phieu_muons', function (Blueprint $table) {
            $table->id('MaPhieuMuon');
            $table->foreignId('MaDG')->references('MaDG')->on('doc_gias')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('MaSach')->references('MaSach')->on('saches')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('NguoiChoMuon');
            $table->date('HanTra')->nullable();
            $table->date('NgayTra')->nullable();
            $table->string('NguoiNhan')->nullable();
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
        Schema::dropIfExists('phieu_muons');
    }
};

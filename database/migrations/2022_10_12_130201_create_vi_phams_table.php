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
    public function up(): void
    {
        Schema::create('vi_phams', function (Blueprint $table) {
            $table->id('MaVP');
            $table->foreignId('MaDG')->references('MaDG')->on('doc_gias')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('LyDoVP');
            $table->string('HinhThucXL');
            $table->string('NguoiXL');
            $table->timestampsTz(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('vi_phams');
    }
};

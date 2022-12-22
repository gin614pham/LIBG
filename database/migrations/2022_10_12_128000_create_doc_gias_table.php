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
        Schema::create('doc_gias', function (Blueprint $table) {
            $table->id('MaDG');
            $table->string('Ten');
            $table->enum('GioiTinh', ['Nam', 'Nữ', 'Khác']);
            $table->date('NgaySinh');
            $table->string('SDT')->unique();
            $table->string('Email')->unique();
            $table->string('NguoiCN');
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
        Schema::dropIfExists('doc_gias');
    }
};

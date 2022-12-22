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
        Schema::create('thanh_lies', function (Blueprint $table) {
            $table->id('MaThanhLy');
//            $table->foreignId('MaSach')->references('MaSach')->on('saches')
//            ->onDelete('cascade')->onUpdate('cascade')->unique();
            $table->unsignedBigInteger('MaSach')->unique();
            $table->foreign('MaSach')->references('MaSach')->on('saches')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('LyDo');
            $table->String('NguoiTL');
            $table->date('NgayTL');
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
        Schema::dropIfExists('thanh_lies');
    }
};

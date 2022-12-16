<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembukuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembukuans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_barang')->unsigned()->nullable();
            $table->integer('id_staff')->nullable();
            $table->string('status')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('bulan')->nullable();
            $table->timestamps();

            $table->foreign('id_barang')->references('id')->on('barangs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembukuans');
    }
}

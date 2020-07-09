<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomenjawabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komenjawab', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jawaban_id')->unsigned();
            $table->text('isi')->nullable();
            $table->timestamps();

            $table->foreign('jawaban_id')->references('id')->on('jawabans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komenjawab');
    }
}

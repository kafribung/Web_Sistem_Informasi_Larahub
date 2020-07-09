<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomentanyaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentanya', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pertanyaan_id')->unsigned();
            $table->text('isi')->nullable();
            $table->timestamps();
            $table->foreign('pertanyaan_id')->references('id')->on('pertanyaans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komentanya');
    }
}

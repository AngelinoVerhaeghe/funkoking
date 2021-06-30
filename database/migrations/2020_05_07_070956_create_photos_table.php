<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('file');
            $table->timestamps();
           /* $table->softDeletes();*/
        });
        //Nieuw Schema voor tussentabel maken
      /* Schema::create('product_photo', function (Blueprint $table){
              $table->bigIncrements('id');
              $table->unsignedBigInteger('product_id');
              $table->unsignedBigInteger('photo_id');
              $table->timestamps();

              //Unique sleutel in de tussentabel
              $table->unique(['product_id', 'photo_id']);
              $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
              $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
          });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}

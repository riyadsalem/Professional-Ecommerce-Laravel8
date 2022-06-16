<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrnadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brnads', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name_en');
            $table->string('brand_name_ar');
            $table->string('brand_slug_en');
            $table->string('brand_slug_ar');
            $table->string('brnad_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brnads');
    }
}

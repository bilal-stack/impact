<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationVariationSizeVariationStyleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variation_variation_size_variation_style', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variation_id');
            $table->unsignedBigInteger('variation_size_id')->nullable();
            $table->unsignedBigInteger('variation_style_id');

            $table->foreign('variation_id')->references('id')->on('variations')->onDelete('cascade');
            $table->foreign('variation_size_id', 'v_size_id')->references('id')->on('variation_sizes')->onDelete('cascade');
            $table->foreign('variation_style_id', 'v_style_id')->references('id')->on('variation_styles')->onDelete('cascade');
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
        Schema::dropIfExists('variation_variation_size_variation_style');
    }
}

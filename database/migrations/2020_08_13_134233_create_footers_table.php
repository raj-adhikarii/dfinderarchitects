<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone');
            $table->string('logo')->nullable();
            $table->string('email');
            $table->Text('location');
            $table->longText('footer_description');
            $table->string('social_facebook');
            $table->string('social_instagram');
            $table->string('social_twitter');
            $table->string('social_linkedin');
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
        Schema::dropIfExists('footers');
    }
}

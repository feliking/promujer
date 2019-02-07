<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_personals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('identity_card');
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('nit');
            $table->string('nationality');
            $table->string('economic_activity');
            $table->string('residence_city');
            $table->string('phone');
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('nro_acount')->nullable();
            $table->string('amount_awarded')->nullable();
            $table->string('detail_amount_awarded')->nullable();
            $table->string('file_identity_card')->nullable();
            $table->string('file_nit')->nullable();
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
        Schema::dropIfExists('provider_personals');
    }
}

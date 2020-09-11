<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pks', function (Blueprint $table) {
            $table->id();
            $table->string('agreement_number',50);
            $table->string('pks_name',150);
            $table->string('npwp_number',50)->nullable();
            $table->string('siup_number',50)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('fax', 20)->nullable();
            $table->bigInteger('province')->nullable();
            $table->bigInteger('city')->nullable();
            $table->bigInteger('district')->nullable();
            $table->bigInteger('sub_district')->nullable();
            $table->double('latitude');
            $table->double('longitude');
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
        Schema::dropIfExists('pks');
    }
}

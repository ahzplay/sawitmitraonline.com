<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('full_name', 75)->nullable();
            $table->string('nick_name', 75)->nullable();
            $table->string('email', 75)->nullable();
            $table->string('phone_number', 25)->nullable();
            $table->string('birth_place', 75)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('address',100)->nullable();
            $table->string('province',15)->nullable();
            $table->string('city',15)->nullable();
            $table->string('district',15)->nullable();
            $table->string('sub_district',15)->nullable();
            $table->tinyInteger('family_title')->default(0);
            $table->text('description')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('profiles');
    }
}

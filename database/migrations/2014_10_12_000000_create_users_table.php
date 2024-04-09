<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('id_types', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_types_id');
            $table->string('document');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('roles_id');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_types_id')->references('id')->on('id_types');
            $table->foreign('roles_id')->references('id')->on('roles');
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('hour');
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('states_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('business_id')->references('id')->on('users');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('states_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('states');
        Schema::dropIfExists('id_types');
    }
};

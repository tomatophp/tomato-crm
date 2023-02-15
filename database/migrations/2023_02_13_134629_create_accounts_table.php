<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->nullable()->constrained('types');

            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('loginBy')->default('email')->nullable();
            $table->text('address')->nullable();

            //Login
            $table->string('password')->nullable();
            $table->string('otp_code')->nullable();
            $table->dateTime('otp_activated_at')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->longText('agent')->nullable();
            $table->string('host')->nullable();
            $table->integer('attempts')->default(0)->nullable();

            //Options
            $table->boolean('login')->default(0)->nullable();
            $table->boolean('activated')->default(0)->nullable();
            $table->boolean('blocked')->default(0)->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('accounts');
    }
};

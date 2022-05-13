<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('username')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->string('email')->unique();
            $table->string('phone_code',15)->nullable();
            $table->string('phone')->nullable();
            $table->decimal('balance', 11, 2)->default(0);

            $table->string('api_token', 80)->nullable();
            $table->string('image')->nullable();
            $table->text('address')->nullable();


            $table->boolean('status')->default(1);
            $table->boolean('email_verification')->default(0);
            $table->boolean('sms_verification')->default(0);
            $table->string('verify_code',20)->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

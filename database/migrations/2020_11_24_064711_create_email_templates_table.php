<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->string('template_key')->nullable();
            $table->string('email_from')->nullable();
            $table->string('name')->nullable();
            $table->string('subject')->nullable();
            $table->text('template')->nullable();
            $table->text('sms_body')->nullable();
            $table->text('short_keys')->nullable();
            $table->boolean('mail_status')->default(0);
            $table->boolean('sms_status')->default(0);
            $table->string('lang_code',10)->nullable();
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
        Schema::dropIfExists('email_templates');
    }
}

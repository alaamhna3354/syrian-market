<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketers', function (Blueprint $table) {
            $table->id();
            $table->string('invitation_code');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('parent_id')->nullable()->constrained('marketers');
            $table->enum('status',['active','disabled','banned'])->default('active');
            $table->integer('is_golden')->default(false);
            $table->integer('remaining_invitation')->default(0);
            $table->string('notes')->nullable();
            $table->enum('last_action',['swap','by_marketer','refund','by_golden'])->nullable();
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
        Schema::dropIfExists('marketers');
    }
}

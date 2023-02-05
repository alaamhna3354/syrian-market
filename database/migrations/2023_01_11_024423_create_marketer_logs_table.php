<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketer_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marketer_id')->constrained();
            $table->foreignId('parent_id')->nullable()->constrained('marketers');
            $table->string('note')->nullable();
            $table->enum('status',['joined','golden_join','swap','refund'])->default('joined');
            $table->float('paid')->default(0);
            $table->integer('earned_points')->default(0);
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
        Schema::dropIfExists('marketer_logs');
    }
}

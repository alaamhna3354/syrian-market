<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddMinPointsAllowedToReplaceFieldToConfiguresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configures', function (Blueprint $table) {
            $table->integer('min_points_allowed_to_replace')->default(100);
        });

        DB::table('templates')->insert(
            array(
                'section_name' => 'points',
                'description' => '{"title":"\u0643\u064a\u0641 \u0627\u0643\u0633\u0628 \u0627\u0644\u0646\u0642\u0627\u0637","short_description":"Description here"}',
                'language_id'=>'9'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('replace_feild_to_configures', function (Blueprint $table) {
            //
        });
    }
}

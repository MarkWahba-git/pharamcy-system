<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsAreaIdPriorityAreaIdFromTablePharmacies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharmacies', function (Blueprint $table) {
            $table->dropcolumn('area_id');
            $table->dropcolumn('priority_area_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pharmacies', function (Blueprint $table) {
            //
        });
    }
}

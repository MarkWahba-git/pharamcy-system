<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsAreaIdAndPriorityAreaIdFromTablePharmacies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharmacies', function (Blueprint $table) {
            $table->dropForeign('pharmacies_area_id_foreign');
            $table->dropForeign('pharmacies_priority_area_id_foreign');
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

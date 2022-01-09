<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateContractTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('contracts', function (Blueprint $table) {
            $table->integer('relationship')->default(0)->change();
            $table->string('relationship_name', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('contracts', function (Blueprint $table) {
            $table->string('relationship')->change();
            $table->dropColumn('relationship_name');
        });
    }
}

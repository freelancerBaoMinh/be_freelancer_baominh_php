<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number', 100)->comment('contract number');
            $table->string('code', 10)->comment('');
            $table->string('name');
            $table->string('company_name');
            $table->timestamp('date_of_birth')->nullable();
            $table->string('cmnd', 20)->index();
            $table->string('agency_ids')->comment('List id agency');
            $table->boolean('gender')->comment('0: Nữ, 1: Nam');
            $table->timestamp('effective_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('package_code')->comment('package code id')->index();
            $table->string('email', 50)->index();
            $table->integer('user_id')->default(0);
            $table->string('relationship');
            $table->boolean('status')->default(1)->comment('0: delete, 1: normal');
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
        Schema::dropIfExists('contracts');
    }
}

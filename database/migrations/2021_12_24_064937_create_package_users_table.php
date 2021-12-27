<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_users', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id')->index();
            $table->integer('user_id')->index();
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
        Schema::dropIfExists('package_users');
    }
}

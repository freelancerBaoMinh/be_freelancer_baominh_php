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
            $table->string('username', 50)->index();
            $table->string('password');
            $table->integer('admin_id')->comment('id amdin create user');
            $table->boolean('status')->comment('0: not active, 1: active')->default(0);
            $table->boolean('role')->comment('0: user,1: nhân viên, 2: giám đốc ');
            $table->string('avatar');
            $table->string('fcm_token')->comment('token push notification');
            $table->boolean('device')->comment('0: Android, 1: IOS');
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

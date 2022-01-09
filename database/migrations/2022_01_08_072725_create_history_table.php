<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->integer('compensation_id')->index();
            $table->boolean('status')->comment('0: accept, 1: cancel')->index();
            $table->text('reason')->comment('Lý do từ chối');
            $table->integer('pay_date')->comment('Ngày chi trả');
            $table->string('pay_total', 50)->comment('Số tiền chi trả');
            $table->integer('user_id')->comment('User yêu cầu')->index();
            $table->integer('date_request')->comment('Ngày yêu cầu');
            $table->text('pay_content')->comment('Nội dung thanh toán');
            $table->integer('admin_id')->comment('Nhân viên xử lý')->index();
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
        Schema::dropIfExists('histories');
    }
}

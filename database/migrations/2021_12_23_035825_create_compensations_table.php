<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompensationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compensations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->string('insurance_name', 100)->comment('Tên người hưởng bảo hiểm');
            $table->integer('birthday');
            $table->string('phone', 12);
            $table->string('cmnd', 20)->index();
            $table->string('email', 50);
            $table->string('level', 50)->comment('Mức bảo hiểm');
            $table->string('pay_request',50);
            $table->integer('day_off')->comment('Số ngày nghỉ');
            $table->boolean('is_cash')->comment('0: bank, 1: cash');
            $table->string('bank_number')->comment('Số tài khoản ngân hàng');
            $table->string('bank_name')->comment('Tên ngân hàng');
            $table->text('bank_addr')->comment('Chi nhánh ngân hàng');
            $table->string('bank_account')->comment('Tên chủ tài khoản');
            $table->integer('date_of_acident')->comment('Ngày khám bệnh/Ngày tai nạn');
            $table->text('diagnose')->comment('Chẩn đoán bệnh/Nguyên nhân bệnh');
            $table->text('hospital_name')->comment('tên bệnh viện');
            $table->integer('date_of_admission')->comment('Ngày nhập viện');
            $table->integer('date_of_discharge')->comment('Ngày xuất viện');
            $table->text('media')->comment('Hình ảnh liên quan');
            $table->boolean('status')->comment('0: đang chờ xử lý, 1: đã xử lý')->index();
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
        Schema::dropIfExists('compensations');
    }
}

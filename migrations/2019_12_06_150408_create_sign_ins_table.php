<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sign_ins', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary()
                ->comment('会员ID');
            $table->unsignedInteger('count')->default(0)
                ->comment('连续签到的天数');
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
        Schema::dropIfExists('sign_ins');
    }
}

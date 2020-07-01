<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('shop_admin')) {
        Schema::create('shop_admin', function (Blueprint $table) {
            $table->increments('admin_id');
            $table->string('admin_account')->nullable($value=true);
            $table->string('admin_moblie')->nullable($value=true);
            $table->string('admin_email')->nullable($value=true);
            $table->string('admin_pwd');
            $table->timestamps();
        });
    }
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member');
    }
}

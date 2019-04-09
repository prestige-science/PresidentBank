<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundsTransferTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('funds_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('transaction_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('funds_transfer');
    }

}

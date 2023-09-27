<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_apis', function (Blueprint $table) {
            $table->bigIncrements('orderId');
            $table->unsignedBigInteger('nurseId');
            $table->unsignedBigInteger('contactId');
            $table->string('totalPrice');
            $table->string('serviceName');
            $table->integer('status')->default(0);
            $table->date('dateOrder');
            $table->time('timeOrder');
            $table->foreign('nurseId')->references('nurseId')->on('nurses');
            $table->foreign('contactId')->references('contactId')->on('contacts');
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
        Schema::dropIfExists('order_apis');
    }
}

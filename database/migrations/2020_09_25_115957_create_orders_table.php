<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('type')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('savior_name')->nullable();
            $table->string('savior_phone')->nullable();
            $table->string('car_type')->nullable();
            $table->date('shipping_date')->nullable();
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('received_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('user_add_id')->nullable();
            $table->unsignedBigInteger('user_accepted_id')->nullable();
            $table->double('amount')->nullable();
            $table->integer('ratio')->nullable();
            $table->double('net')->nullable();

            $table->foreign('company_id')->references('id')->on('companies')
            ->onUpdate('no action')->onDelete('no action');

            $table->foreign('user_add_id')->references('id')->on('users')
            ->onUpdate('no action')->onDelete('no action');

            $table->foreign('user_accepted_id')->references('id')->on('users')
            ->onUpdate('no action')->onDelete('no action');

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
        Schema::dropIfExists('orders');
    }
}

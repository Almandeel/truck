<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnteriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enteries', function (Blueprint $table) {
            $table->id();
            $table->string('details')->nullable();
            $table->double('amount')->nullable()->default('0');
            $table->tinyInteger('type')->default('1');
            $table->unsignedBigInteger('from_id');
            $table->unsignedBigInteger('to_id');
            $table->unsignedBigInteger('user_id');
            $table->index(["user_id"], 'fk_entries_user_id');
            
            $table->index(["from_id"], 'fk_entries_from_idx');
            $table->index(["to_id"], 'fk_entries_to_idx');
            
            $table->foreign('from_id', 'fk_entries_from_idx')
            ->references('id')->on('accounts')
            ->onDelete('no action')
            ->onUpdate('no action');
            
            $table->foreign('to_id', 'fk_entries_to_idx')
            ->references('id')->on('accounts')
            ->onDelete('no action')
            ->onUpdate('no action');
            
            $table->foreign('user_id', 'fk_entries_user_id')
            ->references('id')->on('users')
            ->onDelete('no action')
            ->onUpdate('no action');
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
        Schema::dropIfExists('enteries');
    }
}

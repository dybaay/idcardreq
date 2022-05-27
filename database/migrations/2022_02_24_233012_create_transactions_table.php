<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('card_id');
            $table->decimal('amount', 11, 2);
            $table->string('status');
            $table->string('payment_method');
            $table->string('reference');
            $table->text('description');
            $table->text('payment_proof')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')
                    ->on('users')->onDelete('cascade');
            $table->foreign('card_id')->references('id')
                    ->on('cards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

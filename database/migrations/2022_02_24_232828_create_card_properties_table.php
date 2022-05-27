<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('card_id');
            $table->string('status');
            $table->timestamp('expire_at');
            $table->timestamp('printed_at')->nullable();
            $table->timestamp('ready_at')->nullable();
            $table->timestamp('collected_at')->nullable();
            $table->timestamps();


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
        Schema::dropIfExists('card_properties');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('card_type_id');
            $table->unsignedBigInteger('faculty_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();


            $table->foreign('faculty_id')->references('id')
                    ->on('faculties')->onDelete('cascade');
            $table->foreign('department_id')->references('id')
                    ->on('departments')->onDelete('cascade');
            $table->foreign('card_type_id')->references('id')
                    ->on('card_types')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
                    ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}

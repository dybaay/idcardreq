<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('card_id');
            $table->string('name');
            $table->binary('file');
            $table->string('slug');
            $table->unsignedBigInteger('card_document_type_id');
            $table->timestamps();

            $table->foreign('card_id')->references('id')
                ->on('cards')->onDelete('cascade');
            $table->foreign('card_document_type_id')->references('id')
                ->on('card_document_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_documents');
    }
}

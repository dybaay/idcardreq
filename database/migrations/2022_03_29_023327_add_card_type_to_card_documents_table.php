<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCardTypeToCardDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('card_documents', function (Blueprint $table) {
            $table->unsignedBigInteger('card_type_id')->after('card_document_type_id');

            $table->foreign('card_type_id')->references('id')
                ->on('card_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('card_documents', function (Blueprint $table) {
            $table->dropColumn('card_type_id');
        });
    }
}

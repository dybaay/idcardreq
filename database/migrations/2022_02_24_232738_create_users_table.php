<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_name')->nullable();
            $table->string('identity_no')->index()->unique();
            $table->unsignedBigInteger('faculty_id');
            $table->unsignedBigInteger('department_id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();


            $table->foreign('faculty_id')->references('id')
                        ->on('faculties')->onDelete('cascade');
            $table->foreign('department_id')->references('id')
                        ->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

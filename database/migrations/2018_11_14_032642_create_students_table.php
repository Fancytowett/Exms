<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adm_no')->unique();
            $table->string('fname');
            $table->string('lname');
            $table->string('mname');
            $table->integer('year');
            $table->string('class')->default(1);
            $table->integer('stream_id')->unsigned()->default(1);
            $table->foreign('stream_id')->references('id')->on('streams')->onDelete('cascade');

//            $table->integer('guardian_id')->unsigned();
//            $table->foreign('guardian_id')->references('id')->on('guardians')->onDelete('cascade');
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
        Schema::dropIfExists('students');
    }
}

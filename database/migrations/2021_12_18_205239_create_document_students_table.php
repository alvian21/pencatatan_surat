<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_sd')->unsigned()->index()->nullable();
            $table->foreign('id_sd')->references('id_sd')->on('student_diplomas')->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->date('upload_date');
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
        Schema::dropIfExists('document_students');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_mails', function (Blueprint $table) {
            $table->bigIncrements('id_incoming');
            $table->bigInteger('id_user')->unsigned()->index()->nullable();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->string('reference_number_i');
            $table->date('date_of_receipt');
            $table->date('letter_date_i');
            $table->string('from');
            $table->longText('description_i');
            $table->string('to')->nullable();
            $table->string('position')->nullable();
            $table->string('regarding_i')->nullable();
            $table->string('status')->nullable();
            $table->string('status_description')->nullable();
            $table->string('scan')->nullable();
            $table->string('paraf')->nullable();
            $table->string('letter_code');
            $table->string('description_letter_code');
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
        Schema::dropIfExists('incoming_mails');
    }
}

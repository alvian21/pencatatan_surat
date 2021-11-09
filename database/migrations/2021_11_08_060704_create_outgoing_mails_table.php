<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutgoingMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outgoing_mails', function (Blueprint $table) {
            $table->bigIncrements('id_outgoing');
            $table->bigInteger('id_user')->unsigned()->index()->nullable();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->string('reference_number_o');
            $table->date('letter_date_o');
            $table->string('to');
            $table->string('regarding_o');
            $table->string('attachment');
            $table->string('copy');
            $table->longText('description_o');
            $table->string('disposition_o');
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
        Schema::dropIfExists('outgoing_mails');
    }
}

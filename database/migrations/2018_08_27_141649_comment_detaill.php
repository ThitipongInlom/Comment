<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CommentDetaill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_detaill', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->string('encode')->nullable();
            $table->string('num_save')->nullable();
            $table->string('token_save')->nullable();
            $table->string('radio11')->nullable();
            $table->string('comment11')->nullable();
            $table->string('radio12')->nullable();
            $table->string('comment12')->nullable();
            $table->string('radio13')->nullable();
            $table->string('comment13')->nullable();
            $table->string('radio21')->nullable();
            $table->string('comment21')->nullable();
            $table->string('radio22')->nullable();
            $table->string('comment22')->nullable();
            $table->string('radio23')->nullable();
            $table->string('comment23')->nullable();
            $table->string('radio24')->nullable();
            $table->string('comment24')->nullable();
            $table->string('radio31')->nullable();
            $table->string('comment31')->nullable();
            $table->string('radio310')->nullable();
            $table->string('comment310')->nullable();
            $table->string('radio311')->nullable();
            $table->string('comment311')->nullable();
            $table->string('radio312')->nullable();
            $table->string('comment312')->nullable();
            $table->string('radio32')->nullable();
            $table->string('comment32')->nullable();
            $table->string('radio33')->nullable();
            $table->string('comment33')->nullable();
            $table->string('radio34')->nullable();
            $table->string('comment34')->nullable();
            $table->string('radio35')->nullable();
            $table->string('comment35')->nullable();
            $table->string('radio36')->nullable();
            $table->string('comment36')->nullable();
            $table->string('radio37')->nullable();
            $table->string('comment37')->nullable();
            $table->string('radio38')->nullable();
            $table->string('comment38')->nullable();
            $table->string('radio39')->nullable();
            $table->string('comment39')->nullable();
            $table->string('radio41')->nullable();
            $table->string('comment41')->nullable();
            $table->string('radio42')->nullable();
            $table->string('comment42')->nullable();
            $table->string('radio51')->nullable();
            $table->string('comment51')->nullable();
            $table->string('radio52')->nullable();
            $table->string('comment52')->nullable();
            $table->string('radio53')->nullable();
            $table->string('comment53')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->date('Today');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comment_detaill');
    }
}

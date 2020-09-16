<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id_member');
            $table->string('uniqid_member');
            $table->string('nopol');
            $table->string('nra');
            $table->string('full_name');
            $table->string('pseudonym');
            $table->string('email');
            $table->string('phone');
            $table->text('alamat');
            $table->text('varian');
            $table->text('warna');
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
        Schema::dropIfExists('member');
    }
}

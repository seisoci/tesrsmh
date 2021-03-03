<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formation_id');
            $table->string('full_name');
            $table->string('nickname');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->string('email');
            $table->enum('gender', ['M', 'F']);
            $table->enum('religion', ['islam', 'protestan', 'katolik', 'hindu', 'buddha', 'khonghucu']);
            $table->enum('status', ['menikah', 'belum menikah', 'cerai']);
            $table->integer('height');
            $table->string('no_identity');
            $table->string('address_ktp');
            $table->string('npwp');
            $table->string('address');
            $table->string('phone');
            $table->string('phone_2')->nullable();
            $table->timestamps();
            $table->foreign('formation_id')->references('id')->on('formations')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}

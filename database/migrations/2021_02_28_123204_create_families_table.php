<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id');
            $table->string('full_name');
            $table->enum('gender', ['M', 'F']);
            $table->enum('relationship', ['ayah', 'ibu', 'anak', 'suami', 'istri']);
            $table->enum('last_education', ['sd', 'smp', 'sma', 'diploma', 'sarjana', 'magister', 'doktor']);
            $table->string('birthplace');
            $table->date('birthdate');
            $table->timestamps();
            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('families');
    }
}

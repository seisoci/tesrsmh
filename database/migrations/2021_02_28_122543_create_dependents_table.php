<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id');
            $table->string('full_name');
            $table->enum('gender', ['M', 'F']);
            $table->enum('relationship', ['ayah', 'ibu', 'anak', 'suami', 'istri', 'adik', 'kakak']);
            $table->enum('last_education', ['sd', 'smp', 'sma', 'diploma', 'sarjana', 'magister', 'doktor']);
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
        Schema::dropIfExists('dependents');
    }
}

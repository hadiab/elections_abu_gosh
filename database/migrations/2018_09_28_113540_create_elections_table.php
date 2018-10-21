<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('elections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seq_number')->nullable();
            $table->integer('id_number')->nullable();
            $table->integer('home_number')->nullable();
            $table->string('street')->nullable();
            $table->string('father_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
	    $table->string('belonges_to')->nullable();
	    $table->string('active_person')->nullable();
            $table->string('kalpi')->nullable();
            $table->boolean('voting')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('elections');
    }
}

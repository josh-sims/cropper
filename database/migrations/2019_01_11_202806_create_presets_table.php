<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('presetName');
            $table->string('mode')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('xval')->nullable();
            $table->string('yval')->nullable();
            $table->string('position')->nullable();
            $table->string('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presets');
    }
}

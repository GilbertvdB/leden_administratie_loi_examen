<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familielids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naam');
            $table->string('geboortedatum');
            $table->foreignId('familie_id');
            $table->foreignId('soortlid_id');
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
        Schema::dropIfExists('familielids');
    }
};

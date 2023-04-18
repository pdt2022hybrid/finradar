<?php namespace Appentities\Director\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apidata_directors', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('street');
            $table->string('city');
            $table->string('number');
            $table->string('zip');
            $table->timestamps();

            $table->fullText(['name']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('apidata_directors');
    }
};

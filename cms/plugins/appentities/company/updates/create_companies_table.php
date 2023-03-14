<?php namespace Appentities\Company\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apidata_companies', function(Blueprint $table) {
            $table->id();
            $table->integer('official_id')->index()->unique();
            $table->unsignedBigInteger('ico')->index()->unique();
            $table->unsignedBigInteger('dic')->nullable()->unique();

            $table->integer('legal_form')->nullable();
            $table->integer('ownership_type')->nullable();

            $table->string('name')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_zip')->nullable();

            $table->date('date_of_establishment')->nullable();
            $table->timestamps();

            $table->fullText(['name', 'street', 'city', 'postal_zip']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('apidata_companies');
    }
};

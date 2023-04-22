<?php namespace Appentities\Statement\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apidata_statements', function(Blueprint $table) {
            $table->id();
            $table->bigInteger('official_id')->unique()->index();
            $table->bigInteger('company_id')->unsigned()->index();
            $table->unsignedBigInteger('ico')->index();
            $table->integer('year')->index();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('apidata_statements');
    }
};

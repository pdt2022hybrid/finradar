<?php namespace Appentities\Financialreport\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apidata_reports', function(Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('official_id')->unique();
            $table->unsignedBigInteger('statement_id')->index();
            $table->unsignedBigInteger('ico')->index();
            $table->integer('year')->index();

            $table->bigInteger('revenue')->nullable();
            $table->bigInteger('profits')->nullable();
            $table->bigInteger('assets')->nullable();
            $table->bigInteger('liabilities')->nullable();
            $table->bigInteger('capital')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apidata_reports');
    }
};

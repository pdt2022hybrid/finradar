<?php namespace Appentities\Director\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apidata_company_director_pivot', function(Blueprint $table) {
            $table->integer('company_id')->unsigned()->index();
            $table->integer('director_id')->unsigned()->index();
            $table->date('since');
            $table->primary(['company_id', 'director_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('apidata_company_director_pivot');
    }
};

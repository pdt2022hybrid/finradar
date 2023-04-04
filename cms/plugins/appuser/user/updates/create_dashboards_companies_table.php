<?php namespace Appuser\User\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appuser_dashboards_companies', function(Blueprint $table) {
            $table->integer('dashboard_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->primary(['dashboard_id', 'company_id']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('appuser_dashboards_companies');
    }
};

<?php namespace Appuser\User\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appuser_dashboards', function(Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('appuser_dashboards');
    }
};

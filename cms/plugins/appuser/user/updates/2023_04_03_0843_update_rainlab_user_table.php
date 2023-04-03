<?php namespace Appuser\User\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('appuser_users', function(Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable()->index();
        });
    }
    public function down()
    {
        Schema::table('appuser_users', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};

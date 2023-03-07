<?php namespace Appentities\Financialstatement\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateStatementsTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('apidata_statements', function(Blueprint $table) {
            $table->id();
            $table->bigInteger('official_id')->unique();
            $table->bigInteger('company_id');
            $table->unsignedBigInteger('ico')->index();
            $table->integer('year')->index();
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('apidata_statements');
    }
};

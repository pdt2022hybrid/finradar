<?php namespace Appentities\Report\Updates;

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

            $table->bigInteger('revenue')->default(0);
            $table->bigInteger('profits')->default(0);
            $table->bigInteger('assets_total')->default(0);
            $table->bigInteger('liabilities_total')->default(0);
            $table->bigInteger('capital')->default(0);

            // Assets
            $table->bigInteger('lt_intangible_assets_total')->default(0);
            $table->bigInteger('lt_tangible_assets_total')->default(0);
            $table->bigInteger('lt_financial_assets_total')->default(0);
            $table->bigInteger('st_receivables_total')->default(0);
            $table->bigInteger('financial_accounts_total')->default(0);

            // Liabilities
            $table->bigInteger('base_capital')->default(0);
            $table->bigInteger('result_last_year')->default(0);
            $table->bigInteger('profit_for_period_after_tax')->default(0);
            $table->bigInteger('reserves')->default(0);
            $table->bigInteger('st_liabilities')->default(0);
            $table->bigInteger('bank_loans')->default(0);

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('apidata_reports');
    }
};

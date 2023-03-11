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
            $table->bigInteger('assets_total')->nullable();
            $table->bigInteger('liabilities_total')->nullable();
            $table->bigInteger('capital')->nullable();

            // Assets
            $table->bigInteger('lt_intangible_assets_total')->nullable();
            $table->bigInteger('lt_tangible_assets_total')->nullable();
            $table->bigInteger('lt_financial_assets_total')->nullable();
            $table->bigInteger('st_receivables_total')->nullable();
            $table->bigInteger('financial_accounts_total')->nullable();

            // Liabilities
            $table->bigInteger('base_capital')->nullable();
            $table->bigInteger('result_last_year')->nullable();
            $table->bigInteger('profit_for_period_after_tax')->nullable();
            $table->bigInteger('reserves')->nullable();
            $table->bigInteger('st_liabilities')->nullable();
            $table->bigInteger('bank_loans')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apidata_reports');
    }
};

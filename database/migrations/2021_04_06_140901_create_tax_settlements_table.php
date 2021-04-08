<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('tax_settlements', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('form_code');
            $table->string('form_variant');
            $table->string('date');
            $table->string('system_name');
            $table->string('purpose_of_submission');
            $table->string('office_code');
            $table->string('year');
            $table->string('month');
            $table->string('sales_invoice_ids');
            $table->string('number_of_sale_invoices');
            $table->string('sale_vat');
            $table->string('sale_brutto');
            $table->string('purchase_invoice_ids');
            $table->string('number_of_purchase_invoices');
            $table->string('purchase_vat');
            $table->string('purchase_brutto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_settlements');
    }
}

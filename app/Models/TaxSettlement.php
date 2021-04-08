<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxSettlement extends Model{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'form_code', //KodFormularza
        'form_variant', //WariantFormularza
        'date', //DataWytworzenia
        'system_name', //NazwaSystemu
        'purpose_of_submission', //CelZlozenia
        'office_code', //KodUrzedu
        'year', //Rok
        'month', //Miesiac

        'sales_invoice_ids',
        'number_of_sale_invoices', //LiczbaWierszySprzedazy
        'sale_vat', //PodatekNalezny
        'sale_brutto',

        'purchase_invoice_ids',
        'number_of_purchase_invoices', //
        'purchase_vat', //
        'purchase_brutto'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

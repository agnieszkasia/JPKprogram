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

        'invoice_ids',
        'number_of_invoices', //LiczbaWierszySprzedazy
        'vat', //PodatekNalezny
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

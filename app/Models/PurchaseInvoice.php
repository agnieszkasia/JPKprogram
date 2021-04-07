<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_number',
        'company',
        'street_name',
        'house_number',
        'postal_code',
        'city',
        'nip',
        'issue_date',
        'due_date',
        'vat',
        'netto',
        'brutto'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}

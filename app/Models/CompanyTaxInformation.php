<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyTaxInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'settlement_form',
        'entity_type',
        'office_code',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

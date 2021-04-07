<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'family_name',
        'company',
        'street_name',
        'house_number',
        'postal_code',
        'city',
//        'tax_office',
//        'phone_number',
        'nip',
//        'pesel',
        'birth_date',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function purchaseInvoices(){
        return $this->hasMany(PurchaseInvoice::class);
    }

    public function magazine(){
        return $this->hasOne(Magazine::class);
    }

    public function companyTaxInformation(){
        return $this->hasOne(CompanyTaxInformation::class);
    }

    public function taxSettlements(){
        return $this->hasMany(TaxSettlement::class);
    }


}

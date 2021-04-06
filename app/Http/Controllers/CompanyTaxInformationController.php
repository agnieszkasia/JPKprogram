<?php

namespace App\Http\Controllers;

use App\Models\CompanyTaxInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyTaxInformationController extends Controller
{
    public function create(){
        return view('company_tax_information.create');
    }

    public function store(Request $request){
        $companyTaxInformation = CompanyTaxInformation::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'settlement_form' => $request->input('settlement_form'),
            'entity_type' => $request->input('entity_type'),
            'office_code' => $request->input('office_code'),
        ]);

        $user = Auth::user();
        $user->companyTaxInformation()->save($companyTaxInformation);

        return redirect(route('profile'));
    }
}

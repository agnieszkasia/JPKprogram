<?php

namespace App\Http\Controllers;

use App\Models\CompanyTaxInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyTaxInformationController extends Controller{

    function create(){
        $filename = public_path('files/KodyUrzedowSkarbowych.xsd');
        $xml = simplexml_load_file($filename);
        $data = array();
        $lineCount = 0;

        if ($xml) {
            $lineCount = count($xml->children());
            $data = $this->convertDataFromXmlToArray($xml, $lineCount);
        } else {
            echo 'Błąd ładowania pliku';
        }
        return view('company_tax_information.create', compact('data', 'lineCount'));
    }

    function convertDataFromXmlToArray($xml, $lineCount){
        $data = array();
        for ($i = 0; $i < $lineCount; $i++) {
            $data[$i] = (string)$xml->enumeration[$i]['value']." ".(string)$xml->enumeration[$i]->documentation;
        }
        return $data;
    }

    public function store(Request $request){
        $companyTaxInformation = CompanyTaxInformation::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'settlement_form' => $request->input('settlement_form'),
            'entity_type' => $request->input('entity_type'),
            'office_code' => $request->office_code,
        ]);

        $user = Auth::user();
        $user->companyTaxInformation()->save($companyTaxInformation);

        return redirect(route('profile'));
    }

    public function edit($id){
        $company_tax_information = CompanyTaxInformation::find($id);
        $filename = public_path('files/KodyUrzedowSkarbowych.xsd');
        $xml = simplexml_load_file($filename);
        $data = array();
        $lineCount = 0;

        if ($xml) {
            $lineCount = count($xml->children());
            $data = $this->convertDataFromXmlToArray($xml, $lineCount);
        } else {
            echo 'Błąd ładowania pliku';
        }
        return view('company_tax_information.edit', compact('company_tax_information', 'data', 'lineCount'));
    }

    public function update(Request $request, $id){
        CompanyTaxInformation::find($id)->update([
            'settlement_form' => $request->input('settlement_form'),
            'entity_type' => $request->input('entity_type'),
            'office_code' => $request->office_code,
        ]);
        return redirect(route('profile'));
    }
}

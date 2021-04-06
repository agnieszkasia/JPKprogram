<?php

namespace App\Http\Controllers;

use App\Models\CompanyTaxInformation;
use DOMDocument;
use DOMXPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyTaxInformationController extends Controller
{
    function create(){
//        $filename = file_get_contents(public_path('files/KodyUrzedowSkarbowych.xsd'));
////        $xsd = simplexml_load_string($filename);
//
//        $doc = new DOMDocument();
//        $doc->loadXML(mb_convert_encoding($filename, 'utf-8', mb_detect_encoding($filename)));
//        $xpath = new DOMXPath($doc);
//        $xpath->registerNamespace('xsd', 'http://www.w3.org/2001/XMLSchema');
//        $elementDef = $xpath->evaluate("xsd:schema/xsd:simpleType");
//        $elementDefs = $xpath->evaluate("xsd:restriction/xsd:enumeration/xsd:annotation", $elementDef);
//        dd($elementDefs);

        $attributes = array();
        $xsdstring = public_path('files/KodyUrzedowSkarbowych.xsd');
        $XSDDOC = new DOMDocument();
        $XSDDOC->preserveWhiteSpace = false;
        if ($XSDDOC->load($xsdstring))
        {
            $xsdpath = new DOMXPath($XSDDOC);
            $attributeNodes = $xsdpath->query('//xsd:simpleType[@name="attributeType"]')->item(0);
            foreach ($attributeNodes->childNodes as $attr)
            {
                $attributes[ $attr->getAttribute('value') ] = $attr->getAttribute('name');
            }
            unset($xsdpath);
        }
        print_r($attributes);

        return view('company_tax_information.create');
    }

    function convertDataFromXds($xsd, $lineCount)
    {
        $data = array();
        for ($i = 0; $i < $lineCount; $i++) {
            $data[$i][0] = (string)$xsd->laptop[$i]->manufacturer;
        }
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

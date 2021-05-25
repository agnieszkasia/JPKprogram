<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\PurchaseInvoice;
use App\Models\TaxSettlement;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxSettlementController extends Controller{

    function showAllTaxSettlement(Request $request){
        $user = Auth::user();
        $taxSettlements = $user->taxSettlements();

        $this->sort($taxSettlements, $request);
        $taxSettlements = $taxSettlements->get();

        $i = 0;
        foreach ($taxSettlements as $taxSettlement){
            $taxSettlements[$i]->vat = $taxSettlement->sale_vat - $taxSettlement->purchase_vat;
            $i++;
        }
        return view('tax_settlements.show_all', compact('taxSettlements'));
    }

    public function sort($taxSettlements, $request){
        if ($request['sort'] == 'asc_issue_date') { $taxSettlements->orderBy('year', 'asc')->orderBy('month', 'asc');}
        if ($request['sort'] == 'desc_issue_date') { $taxSettlements->orderBy('year', 'desc')->orderBy('month', 'desc');}
//        if ($request['sort'] == '') { $taxSettlements->orderBy('year', 'desc')->orderBy('month', 'desc');}

        return $taxSettlements;
    }

    public function create(){
        $user = Auth::user();
        $taxSettlements = $user->taxSettlements;
        $invoices = $user->invoices;

        $dates = $this->getUniqueInvoiceDates($invoices);
        $taxSettlementsDates = $this->getTaxSettlementDates($taxSettlements);


        list($taxSettlementsDatesToCreate,$years) = $this->getTaxSettlementDatesToCreate($dates, $taxSettlementsDates);
        $months = $this->getMonthsDependingOnYears($years, $taxSettlementsDatesToCreate);

        return view('tax_settlements.create', compact('years', 'months'));
    }

    public function getUniqueInvoiceDates($invoices): array{
        $dates = array();
        $i=0;
        foreach ($invoices as $invoice){
            $date = substr($invoice->issue_date, 0, -3);

            if (!in_array($date, $dates)) {
                $dates[$i] = $date;
                $i++;
            }
        }
        return $dates;
    }

    public function getTaxSettlementDates($taxSettlements): array{
        $taxSettlementDates = array();
        $i = 0;
        foreach ($taxSettlements as $taxSettlement){
            $taxSettlementDates[$i] = $taxSettlement->year."-".$taxSettlement->month;
            $i++;
        }
        return $taxSettlementDates;
    }

    public function getTaxSettlementDatesToCreate($dates, $taxSettlementsDates): array{
        $taxSettlementsDatesToCreate = array();
        $years = array();
        $i = 0;
        $j = 0;
        foreach ($dates as $date){
            if (!in_array($date,$taxSettlementsDates)){
                $taxSettlementsDatesToCreate[$i] = $date;
                if (!in_array(substr($date, 0, -3),$years)) {
                    $years[$j] = substr($date, 0, -3);
                    $j++;
                }
                $i++;
            }

        }
        array_multisort($years);

        return array($taxSettlementsDatesToCreate, $years);
    }

    public function getMonthsDependingOnYears($years, $dates): array{
        $months = array();
        foreach ($years as $year) {
            $j=0;
            foreach ($dates as $date) {
                if (substr($date, 0, -3) ==$year){
                    $months[$year][$j] = substr($date, 5, 2);
                    $j++;
                }
            }
        }
        return $months;
    }

    public function generate(Request $request){
        $user = Auth::user();
        $period = $request->period;
        $invoices = $user->invoices;
        $purchaseInvoices = $user->purchaseInvoices;

        list($totalMonthlySalesValues, $invoicesData) = $this->getTotalMonthlyValue($invoices, $period);
        list($totalMonthlyPurchaseValues, $purchaseInvoicesData) = $this->getTotalMonthlyValue($purchaseInvoices, $period);

        return view('tax_settlements.pre_save', compact(
                                    'period',
                                    'invoicesData',
                                    'purchaseInvoicesData',
                                    'totalMonthlySalesValues',
                                    'totalMonthlyPurchaseValues'));
    }

    public function getTotalMonthlyValue($invoices, $period): array{
        $totalMonth['vat'] = 0;
        $totalMonth['netto'] = 0;
        $totalMonth['brutto'] = 0;

        $i = 0;
        $invoicesData = array();

        foreach ($invoices as $invoice) {
            $invoiceDate = substr($invoice->issue_date, 0, -3);
            if ($invoiceDate == $period){
                $invoicesData[$i] = $invoice;

                $totalMonth['vat'] = $totalMonth['vat'] +($invoicesData[$i]->vat);
                $totalMonth['netto'] = $totalMonth['netto']+($invoicesData[$i]->netto);
                $totalMonth['brutto'] = $totalMonth['brutto']+($invoicesData[$i]->brutto);

                $i++;
            }
        }
        return array($totalMonth, $invoicesData);
    }


    public function store(Request $request){

        if ($request->input('sale_invoice_ids') == null){
            $saleInvoiceIds ="";
        } else {
            $saleInvoiceIds = implode(';', $request->input('sale_invoice_ids'));
        }

        if ($request->input('purchase_invoice_ids') == null){
            $purchaseInvoiceIds ="";
        } else {
            $purchaseInvoiceIds = implode(';', $request->input('purchase_invoice_ids'));
        }

        $user = Auth::user();
        $companyTaxInformation = $user->companyTaxInformation;


        $taxSettlement = TaxSettlement::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'form_code' => $companyTaxInformation->settlement_form,
            'form_variant' => '1',
            'date' => Carbon::now()->toDateTimeString(),
            'system_name' => 'EJPK',
            'purpose_of_submission' => '1',
            'office_code' => substr($companyTaxInformation->office_code,0,4),
            'year' => substr($request->period, 0, -3),
            'month' => substr($request->period, 5, 2),

            'sales_invoice_ids' => $saleInvoiceIds,
            'number_of_sale_invoices' => $request->input('number_of_sale_invoices'),
            'sale_vat' => $request->input('sale_vat'),
            'sale_brutto' => $request->input('sale_brutto'),

            'purchase_invoice_ids' => $purchaseInvoiceIds,
            'number_of_purchase_invoices' => $request->input('number_of_purchase_invoices'),
            'purchase_vat' => $request->input('purchase_vat'),
            'purchase_brutto' => $request->input('purchase_brutto'),
        ]);

        $user = Auth::user();
        $user->taxSettlements->add($taxSettlement);

        return redirect(route('show_tax_settlements'));
    }

    public function show($id){
        $taxSettlement = TaxSettlement::find($id);
        $salesInvoiceIds = explode(';',$taxSettlement->sales_invoice_ids);
        $purchaseInvoiceIds = explode(';',$taxSettlement->purchase_invoice_ids);
        $i = 0;
        foreach ($salesInvoiceIds as $invoiceId) {
            $salesInvoicesData[$i] = Invoice::find($invoiceId);
            $i++;
        }
        $i=0;
        foreach ($purchaseInvoiceIds as $invoiceId) {
            $purchaseInvoicesData[$i] = PurchaseInvoice::find($invoiceId);
            $i++;
        }

        return view('tax_settlements.show',compact('taxSettlement', 'salesInvoicesData', 'purchaseInvoicesData'));

    }

    public function destroy($id){
        TaxSettlement::find($id)->delete();
        return redirect(route('show_tax_settlements'));
    }

    public function generateXMLFile($id){
        $user = Auth::user();
        $entity = $user->companyTaxInformation;
        $entityTypeName = $entity->entity_type;

        $taxSettlement = TaxSettlement::find($id);


        $file = new DOMDocument();

        /* Format XML to save indented tree rather than one line */
        $file->preserveWhiteSpace = true;
        $file->formatOutput = true;

        /* tag - JPK */
        $JPK = $file->createElement("JPK");

        $JPKAttribute = $file->createAttribute('xmlns:etd');
        $JPKAttribute->value = "http://crd.gov.pl/xml/schematy/dziedzinowe/mf/2020/03/11/eD/DefinicjeTypy/";
        $JPK->appendChild($JPKAttribute);

        $JPKAttribute = $file->createAttribute('xmlns:xsi');
        $JPKAttribute->value = "http://www.w3.org/2001/XMLSchema-instance";
        $JPK->appendChild($JPKAttribute);

        $JPKAttribute = $file->createAttribute('xmlns');
        $JPKAttribute->value = "http://crd.gov.pl/wzor/2020/05/08/9393/";
        $JPK->appendChild($JPKAttribute);

        $JPKAttribute = $file->createAttribute('xsi:schemaLocation');
        $JPKAttribute->value = "http://crd.gov.pl/wzor/2020/05/08/9393/ http://crd.gov.pl/wzor/2020/05/08/9393/schemat.xsd";
        $JPK->appendChild($JPKAttribute);

        $file->appendChild($JPK);

            /* tag - Naglowek*/
            $head = $file->createElement("Naglowek");
            $JPK->appendChild($head);

                /* tag - KodFormularza */
                $formCode = $file->createElement("KodFormularza", 'JPK_VAT');

                $formCodeAttribute = $file->createAttribute('kodSystemowy');
                $formCodeAttribute->value = $taxSettlement->form_code." (1)";
                $formCode->appendChild($formCodeAttribute);

                $formCodeAttribute = $file->createAttribute('wersjaSchemy');
                $formCodeAttribute->value = '1-2E';
                $formCode->appendChild($formCodeAttribute);

                $head->appendChild($formCode);

                /* tag - WariantFormularza */
                $formVariant = $file->createElement("WariantFormularza", $taxSettlement->form_variant);
                $head->appendChild($formVariant);

                /* tag - DataWytworzeniaJPK */
                $date = $file->createElement("DataWytworzeniaJPK", $taxSettlement->date);
                $head->appendChild($date);

                /* tag - NazwaSystemu */
                $systemName = $file->createElement("NazwaSystemu", $taxSettlement->system_name);
                $head->appendChild($systemName);

                /* tag - CelZlozenia */
                $purposeOfSubmission = $file->createElement("CelZlozenia", $taxSettlement->purpose_of_submission);
                $purposeOfSubmissionAttribute = $file->createAttribute('poz');
                $purposeOfSubmissionAttribute->value = 'P_7';
                $purposeOfSubmission->appendChild($purposeOfSubmissionAttribute);
                $head->appendChild($purposeOfSubmission);

                /* tag - KodUrzedu */
                $officeCode = $file->createElement("KodUrzedu", $taxSettlement->office_code);
                $head->appendChild($officeCode);

                /* tag - Rok */
                $year = $file->createElement("Rok", $taxSettlement->year);
                $head->appendChild($year);

                /* tag - Miesiac */
                $month = $file->createElement("Miesiac", $taxSettlement->month);
                $head->appendChild($month);

            /* tag - Podmiot1 */
            $entity = $file->createElement("Podmiot1");
            $entityAttribute = $file->createAttribute('rola');
            $entityAttribute->value = "Podatnik";
            $entity->appendChild($entityAttribute);
            $JPK->appendChild($entity);

                /* tag - Osoba fizyczna/niefizyczna */
                if ($entityTypeName == '1'){
                    $entityType = $file->createElement("OsobaFizyczna");
                } elseif ($entityTypeName == '2') {
                    $entityType = $file->createElement("OsobaNiefizyczna");
                }
                $entity->appendChild($entityType);

                    /* tag - etd:NIP */
                    $nip = $file->createElement("etd:NIP", $user->nip);
                    $entityType->appendChild($nip);

                    /* tag - etd:ImiePierwsze */
                    $firstName = $file->createElement("etd:ImiePierwsze", $user->first_name);
                    $entityType->appendChild($firstName);

                    /* tag - etd:Nazwisko */
                    $familyName = $file->createElement("etd:Nazwisko", $user->family_name);
                    $entityType->appendChild($familyName);

                    /* tag - etd:DataUrodzenia */
                    $birthDate = $file->createElement("etd:DataUrodzenia", $user->birth_date);
                    $entityType->appendChild($birthDate);

                    /* tag - Email */
                    $email = $file->createElement("Email", $user->email);
                    $entityType->appendChild($email);

            /* tag - Deklaracja */
            $declaration = $file->createElement("Deklaracja");
            $JPK->appendChild($declaration);

                /* tag - Naglowek */
                $declarationHead = $file->createElement("Naglowek");
                $declaration->appendChild($declarationHead);

                    /* tag - KodFormularzaDekl */
                    $declarationFormCode = $file->createElement("KodFormularzaDekl", 'VAT-7');

                    /* kodSystemowy */
                    $declarationFormCodeAttribute = $file->createAttribute('kodSystemowy');
                    $declarationFormCodeAttribute->value = "VAT-7 (21)";
                    $declarationFormCode->appendChild($declarationFormCodeAttribute);

                    /* kodPodatku */
                    $declarationFormCodeAttribute = $file->createAttribute('kodPodatku');
                    $declarationFormCodeAttribute->value = "VAT";
                    $declarationFormCode->appendChild($declarationFormCodeAttribute);

                    /* rodzajZobowiazania */
                    $declarationFormCodeAttribute = $file->createAttribute('rodzajZobowiazania');
                    $declarationFormCodeAttribute->value = "Z";
                    $declarationFormCode->appendChild($declarationFormCodeAttribute);

                    /* wersjaSchemy */
                    $declarationFormCodeAttribute = $file->createAttribute('wersjaSchemy');
                    $declarationFormCodeAttribute->value = "1-2E";
                    $declarationFormCode->appendChild($declarationFormCodeAttribute);

                    $declarationHead->appendChild($declarationFormCode);


                    /* tag - WariantFormularzaDekl */
                    $declarationFormVariant = $file->createElement("WariantFormularzaDekl", '21');
                    $declarationHead->appendChild($declarationFormVariant);

                /* tag - PozycjeSzczegolowe */
                $detailedItems = $file->createElement("PozycjeSzczegolowe");
                $declaration->appendChild($detailedItems);

                    /* tag - P_ORDZU */
                    $P_ORDZU = $file->createElement("P_ORDZU", 'null');
                    $detailedItems->appendChild($P_ORDZU);


            /* tag - Ewidencja */
            $register = $file->createElement("Ewidencja");
            $JPK->appendChild($register);

            $this->getSalesInvoicesToXMLFormat($taxSettlement, $register, $file);
            $this->getPurchaseInvoicesToXMLFormat($taxSettlement, $register, $file);


        /*download file */
        $filename = $taxSettlement->form_code.' '.$taxSettlement->year.'_'.$taxSettlement->month.' - zlozenie po raz pierwszy - '.'.xml';
        $file->save($filename);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Content-Length: ' . filesize($filename));
        header('Pragma: public');
        readfile($filename);
        unlink($filename);

    }

    public function getSalesInvoicesToXMLFormat($taxSettlement, $register, $file){

        $salesInvoiceIds = explode(';',$taxSettlement->sales_invoice_ids);

        foreach ($salesInvoiceIds as $invoiceId){

            $invoice = Invoice::find($invoiceId);

            /* tag - SprzedazWiersz */
            $salesRow = $file->createElement("SprzedazWiersz");
            $register->appendChild($salesRow);

                /* tag - LpSprzedazy */
                $sales = $file->createElement("LpSprzedazy", ($invoiceId+1));
                $salesRow->appendChild($sales);

                /* tag - NrKontrahenta */
                $nip = $file->createElement("NrKontrahenta", $invoice->nip);
                $salesRow->appendChild($nip);

                /* tag - NazwaKontrahenta */
                $company = $file->createElement("NazwaKontrahenta", $invoice->company);
                $salesRow->appendChild($company);

                /* tag - DowodSprzedazy */
                $invoiceNumber = $file->createElement("DowodSprzedazy", $invoice->invoice_number);
                $salesRow->appendChild($invoiceNumber);

                /* tag - DataWystawienia */
                $issueDate = $file->createElement("DataWystawienia", $invoice->issue_date);
                $salesRow->appendChild($issueDate);

                /* tag - DataSprzedazy */
                $dueDate = $file->createElement("DataSprzedazy", $invoice->due_date);
                $salesRow->appendChild($dueDate);

                /* tag - K_19 */
                $netto = $file->createElement("K_19", $invoice->netto);
                $salesRow->appendChild($netto);

                /* tag - K_20 */
                $vat = $file->createElement("K_20", $invoice->vat);
                $salesRow->appendChild($vat);

        }

        /* tag - SprzedazCtrl */
        $salesCtrl = $file->createElement("SprzedazCtrl");
        $register->appendChild($salesCtrl);

        /* tag - LiczbaWierszySprzedazy */
        $rowNumber = $file->createElement("LiczbaWierszySprzedazy", $taxSettlement->number_of_sale_invoices);
        $salesCtrl->appendChild($rowNumber);

        /* tag - PodatekNalezny */
        $totalVAT = $file->createElement("PodatekNalezny", $taxSettlement->sale_vat);
        $salesCtrl->appendChild($totalVAT);


    }

    public function getPurchaseInvoicesToXMLFormat($taxSettlement, $register, $file){
        if ($taxSettlement->purchase_invoice_ids !== "") {
            $purchaseInvoiceIds = explode(';', $taxSettlement->purchase_invoice_ids);
            foreach ($purchaseInvoiceIds as $invoiceId) {

                $invoice = PurchaseInvoice::find($invoiceId);

                /* tag - ZakupWiersz */
                $purchaseRow = $file->createElement("ZakupWiersz");
                $register->appendChild($purchaseRow);

                    /* tag - LpZakupu */
                    $sales = $file->createElement("LpZakupu", ($invoiceId + 1));
                    $purchaseRow->appendChild($sales);

                    /* tag - NrDostawcy */
                    $nip = $file->createElement("NrDostawcy", $invoice->nip);
                    $purchaseRow->appendChild($nip);

                    /* tag - NazwaDostawcy */
                    $company = $file->createElement("NazwaDostawcy", $invoice->company);
                    $purchaseRow->appendChild($company);

                    /* tag - DowodZakupu */
                    $invoiceNumber = $file->createElement("DowodZakupu", $invoice->invoice_number);
                    $purchaseRow->appendChild($invoiceNumber);

                    /* tag - DataZakupu */
                    $issueDate = $file->createElement("DataZakupu", $invoice->issue_date);
                    $purchaseRow->appendChild($issueDate);

                    /* tag - DataWplywu */
                    $dueDate = $file->createElement("DataWplywu", $invoice->due_date);
                    $purchaseRow->appendChild($dueDate);

                    /* tag - K_42 */
                    $netto = $file->createElement("K_42", $invoice->netto);
                    $purchaseRow->appendChild($netto);

                    /* tag - K_43 */
                    $vat = $file->createElement("K_43", $invoice->vat);
                    $purchaseRow->appendChild($vat);

            }

            /* tag - ZakupCtrl */
            $purchaseCtrl = $file->createElement("ZakupCtrl");
            $register->appendChild($purchaseCtrl);

            /* tag - LiczbaWierszyZakupow */
            $rowNumber = $file->createElement("LiczbaWierszyZakupow", $taxSettlement->number_of_purchase_invoices);
            $purchaseCtrl->appendChild($rowNumber);

            /* tag - PodatekNaliczony */
            $totalVAT = $file->createElement("PodatekNaliczony", $taxSettlement->purchase_vat);
            $purchaseCtrl->appendChild($totalVAT);

        }

    }
}

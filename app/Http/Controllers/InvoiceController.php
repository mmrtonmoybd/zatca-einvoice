<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Sale;
use Illuminate\Support\Facades\Gate;
use Omaralalwi\Gpdf\Facade\Gpdf as GpdfFacade;
use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\InvoiceDate;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\Seller;
use Salla\ZATCA\Tags\TaxNumber;
use Illuminate\Support\Facades\Config;
use Omaralalwi\Gpdf\Enums\{GpdfDefaultSettings as GpdfDefault,
    GpdfSettingKeys as GpdfSet,
    GpdfDefaultSupportedFonts,
    GpdfStorageDrivers};

class InvoiceController
{
    public function index(Sale $sale)
    {

        Gate::authorize('access-sale', $sale);

        Config::set('gpdf.'.GpdfSet::DEFAULT_PAPER_SIZE, 'a4');
       // Config::set('gpdf.'.GpdfSet::DPI, 300);
        //Config::set('gpdf.'.GpdfSet::DEFAULT_FONT, GpdfDefaultSupportedFonts::COURIER);


        $company = Company::where('team_id', auth()->user()->currentTeam->id)->first();

        $qrcode = GenerateQrCode::fromArray([
            new Seller($company->name), // seller name
            new TaxNumber($company->vat_number), // seller tax number
            new InvoiceDate($sale->date), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
            new InvoiceTotalAmount($sale->grand_total), // invoice total amount
            new InvoiceTaxAmount($sale->final_total_tax), // invoice tax amount
            // .......
        ])->render();

        $html = view('wh-invoice', compact('sale', 'company', 'qrcode'))->render();
        $pdfContent = GpdfFacade::generate($html);

        return response($pdfContent, 200, ['Content-Type' => 'application/pdf']);
    }
}

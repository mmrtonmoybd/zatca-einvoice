<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>فاتورة ضريبية / VAT INVOICE - {{ $sale->bill_number }}</title>

<style>
  @page {
    margin: 0in 0.5in;
  }

    :root {
      --accent: #0a5aa1;
      --text: #222;
      --muted: #000000ff;
      --border: #000000ff;
      --bg: #fff;
    }

    * { box-sizing: border-box; }

  html, body {
    font-family: DejaVu Sans, sans-serif;
    margin: 0;
    padding: 1.8in 20px 1in; /* leave space for header/footer images */
    direction: rtl;
    font-size: 11px;
    background: #fff;
  }

  header, footer {
    position: fixed;
    left: 20px;
    right: 20px;
    text-align: center;
    z-index: 1;
  }

  header {
    top: 3px;
    height: 1.4in;
  }

  footer {
    bottom: 0;
    height: 0.8in;
  }

  /* Ensure content stays below header image */
  main {
    position: relative;
    z-index: 2;
  }

  .page-banner {
    width: 100%;
    height: 100%;
    object-fit: contain;
    object-position: center center;
  }

  /* Header text on banner */
  .invoice-title {
    position: absolute;
    top: 1.5in;
    left: 20px;
    right: 20px;
    text-align: center;
    color: #ffffffff;
    font-size: 15px;
    font-weight: bold;
    background-color: #043670ff;
    z-index: 3;
  }

  /* Table styling */
    .title {
      display: flex; flex-direction: column; gap: 4px;
    }
    .title h1 {
      margin: 0; font-size: 15px; font-weight: 700; color: #fff;
      text-align: center;
      background-color: #043670ff;
    }
    .title .subtitle { font-size: 11px; color: var(--muted); text-align: center; }
    .invoice-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 9px;
  color: var(--text);
  direction: ltr; /* keeps the overall layout left-to-right */
  margin-bottom: 8px;
}

.invoice-meta .left {
  text-align: left;
}

.invoice-meta .right {
  text-align: right;
  direction: rtl;
}

.invoice-meta .no {
  font-weight: 600;
  color: var(--accent);
}

.latin {
  direction: ltr;
  unicode-bidi: embed;
  font-family: 'DejaVu Sans', sans-serif;
}

/* invoice meta inline (table version for dompdf compatibility) */
.invoice-meta-inline {
  width: 100%;
  border-collapse: collapse;
  table-layout: fixed;
  margin: 0;             /* align with surrounding header */
}
.invoice-meta-inline td {
  border: none;
  padding: 0;
  vertical-align: middle;
  font-size: 11px;
  white-space: nowrap;   /* keep each cell on single line */
}

/* left cell */
.invoice-meta-inline .meta-left {
  text-align: left;
  direction: ltr;
  width: 50%;
  padding-left: 4px;
}

/* right cell */
.invoice-meta-inline .meta-right {
  text-align: right;
  direction: rtl;
  width: 50%;
  padding-right: 4px;
}

/* small helpers */
.invoice-meta-inline .no { font-weight: 600; color: var(--accent); }
.latin { direction: ltr; unicode-bidi: embed; font-family: 'DejaVu Sans', sans-serif; }
.muted { color: var(--muted); }

    .invoice-meta .no { font-weight: 600; color: var(--accent); }

    h2.section-title {
      margin: 18px 0 8px; font-size: 11px; color: var(--accent);
      border-bottom: 1px dashed var(--border); padding-bottom: 2px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 6px 0 6px;
      background: #fff;
    }
    th, td {
      border: 1px solid var(--border);
      padding: 3px 10px;
      vertical-align: middle;
      font-size: 9px;
    }
    th {
      background: #043670ff;
      color: #ffffffff;
      font-weight: 400;
      text-align: center;
    }
    td { color: var(--text); }
    .ltr {
  direction: ltr;
  unicode-bidi: bidi-override;
  text-align: left;
}
    .rtl {
  direction: rtl;
  unicode-bidi: bidi-override;
  text-align: right;
  
}
.latin {
  direction: ltr;
  unicode-bidi: embed;
  font-family: 'DejaVu Sans', sans-serif;
}

    .muted { color: var(--muted); }
    .nowrap { white-space: nowrap; }

    .items th, .totals th { font-size: 11px; }
    .items td { font-size: 9px; }
    .money { text-align: center; direction: ltr; font-variant-numeric: tabular-nums; }
    .center { text-align: center; }
    .right { text-align: right; }
    .accent-row td { background: #fbfdff; font-weight: 600; }

    .grid-two {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    table.items {
  width: 100%;
  border-collapse: collapse;
}

table.items thead {
  display: table-header-group;
}

table.items tfoot {
  display: table-footer-group;
}


    .bank th { text-align: center; }

  .section-title {
    text-align: center;
    color: #043670;
    border-bottom: 1px dashed #000;
    margin: 12px 0;
    font-size: 12px;
  }
</style>
</head>

<body>

  <!-- HEADER IMAGE -->
  <header>
    <img class="page-banner" src="{{ public_path('storage/'.auth()->user()->currentTeam->header_bannar) }}" alt="Header Banner">
  </header>

  <!-- FOOTER IMAGE -->
  <footer>
    <img class="page-banner" src="{{ public_path('storage/'.auth()->user()->currentTeam->footer_bannar) }}" alt="Footer Banner">
  </footer>

  <!-- HEADER TITLE -->
  <div class="invoice-title">VAT INVOICE /  فاتورة ضريبة القيمة المضافة </div>
  <table class="invoice-meta-inline" role="presentation">
  <tr>
    <td class="meta-left">
      <span class="no">No:</span> {{ $sale->bill_number }}
    </td>
    <td class="meta-right muted rtl">
      <span dir="ltr" class="latin">SL-{{ toArabicIndicDigits(str_replace('SL-', '', $sale->bill_number)) }}</span>
      : <span>رقم الفاتورة</span>
    </td>
  </tr>
</table>

  <main>

    <!-- Company Info -->
    <table style="table-layout: fixed; border:none;">

      <tr>
        <td class="ltr">From: {{ $company->name }}</td>
        <td class="rtl"> {{ $company->arabic_name }} :حسب</td>
        

      </tr>
      <tr>
        <td class="ltr">Address: {{ $company->address }}</td>
        <td class="rtl">    {{ $company->arabic_address }}: عنوان</td>
        
      </tr>
      <tr>
        <td class="ltr">VAT: {{ $company->vat_number }}</td>
        <td class="rtl">{{ $company->arabic_vat_number }} :قيمة ارتفاع الضرائب </td>
        

      </tr>

      <tr>
        <td class="ltr">CR No: {{ $company->cr_no }}</td>
        <td class="rtl">{{ $company->arabic_cr_no }}: رقم السجل التجاري</td>
        

      </tr>
    </table>

    <!-- To -->

    <table style="table-layout: fixed;">
      <tr>
        <td class="ltr">To: {{ $sale->customer->name }}</td>
        <td class="rtl">على: {{ $sale->customer->arabic_name }} </td>
        

      </tr>
      <tr>
        <td class="ltr">Address: {{ $sale->customer->address }}</td>
        <td class="rtl">عنوان: {{ $sale->customer->arabic_address }}</td>
        
      </tr>
      <tr>
        <td class="ltr">VAT: {{ $sale->customer->vat_no }}</td>
        <td class="rtl">{{ $sale->customer->arabic_vat_no }} ۳۱۰۰٥۹۹۷۹۹۰۰۰۰۳ :قيمة ارتفاع الضرائب </td>
        

      </tr>

      <tr>
        <td class="ltr">CR No: {{ $sale->customer->cr_no }}</td>
        <td class="rtl">{{ $sale->customer->arabic_cr_no }}: رقم السجل التجاري</td>

      </tr>
    </table>

    <!-- Dates -->

    <table>
      <tr style="font-size: 6px !important;">
        <th>تاريخ الفاتورة | Invoice date</th>
        <th>تاريخ التوريد | Supply date</th>
        <th>رقم التعاقد | Contract / PO No</th>
        <th>تاريخ الاستحقاق | Due date</th>
        <th>فترة الفاتورة | Invoice period</th>
        <th>رقم المشروع | Project / Reference No</th>
      </tr>
      <tr>
        <td class="center">{{ $sale->date }}</td>
        <td class="center">{{ $sale->delivery_date }}</td>
        <td class="center">{{ $sale->po_eference }}</td>
        <td class="center">{{ $sale->due_date }}</td>
        <td class="center">{{ $sale->invoice_period }}5</td>
        <td class="center">{{ $sale->project_reference }}</td>
      </tr>
    </table>

    <!-- Items -->

    <table class="items">
      <thead>
      <tr>

      <th>المجموع (ر.س) | Total</th>
      <th>ضريبة القيمة المضافة | VAT amount</th>
      <th>نسبة الضريبة | VAT %</th>
      <th>الإجمالي بدون الضريبة | Total excl. VAT</th>
      <th>سعر الوحدة | Unit price</th>
      <th>الكمية | Qty</th>
      <th>الوحدة | Unit</th>
      <th>الوصف | Description</th>
      <th>الشفرة | Code</th>
      <th>#</th>

      </tr>
    </thead>
    <tbody>
      @foreach ($sale->products as $key => $productData)
      <tr>
        <td class="money">{{ $productData['total_amount'] }}</td>
        <td class="money">{{ $productData['total_tax'] }}</td>
        <td class="center">{{ $productData['vat'] }}</td>
        <td class="money">{{ $productData['total_amount'] - $productData['total_tax'] }}</td>
        <td class="money">{{ $productData['sale_price'] }}</td>
        <td class="center">{{ $productData['quantity'] }}</td>
        <td class="center">{{ optional(\App\Models\Unit::find($productData['unit_id']))->short_name }}</td>
        @php
        $product = \App\Models\Product::find($productData['product_id']);
        @endphp
        <td class="rtl">{{ $product->name }} / {{ $product->arabic_name }} </td>
        <td class="center">{{ $product->code }}</td>
        <td class="center">{{ $key + 1 }}</td>
      </tr>
      @endforeach
</tbody>
    </table>

    <!-- Totals -->

    <table class="totals" style="table-layout: fixed;">
      <tr class="accent-row">
        <td class="rtl" style="font-size: 14px; text-align: center;"><strong>{{ $sale->final_total_amount }} SAR : Total /  المجموع </strong> </td>
        <td class="rtl" style="font-size: 12px; text-align: center;"><strong>{{ $sale->final_total_tax }} SAR : Total VAT/ إجمالي ضريبة القيمة المضافة</strong></td>
      </tr>
      <tr>
        <td class="rtl" style="font-size: 12px; text-align: center;"><strong>{{ $sale->grand_total }} SAR : Grand Total / المجموع الإجمالي</strong></td>
        <td class="rtl" style="font-size: 12px; text-align: center;"><strong>{{ $sale->grand_total }} SAR : Balance Due / الرصيد المستحق</strong></td>
      </tr>
      <tr>
        <td class="ltr"><strong>Amount in words:</strong> {{ \Rmunate\Utilities\SpellNumber::value($sale->grand_total)->currency('Saudi Riyals')->locale('en')->toMoney() }}</td>
        <td class="rtl"><strong>     المبلغ بالكلمات : {{ \Illuminate\Support\Number::spell($sale->grand_total, 'ar') }} ريال سعودي</strong></td>
      </tr>
    </table>

    <!-- Bank details -->
    <h2 class="section-title center">تفاصيل البنك  Bank details</h2>
    <table class="bank" style="table-layout: fixed;">
      <tr>
        
        <th colspan="4">BANK DETAILS</th>
      </tr>
      <tr>
        <td class="center">Account Name</td>
        <td class="ltr">{{ $company->bank_account_name }}</td>
        <td class="rtl">{{ $company->arabic_bank_account_name }}</td>
        <td class="rtl">اسم الحساب</td>
      </tr>
      <tr>
        <td class="center">Bank Name</td>
        <td class="ltr">{{ $company->bank_name }} </td>
        <td class="rtl">{{ $company->arabic_bank_name }}</td>
        <td class="rtl">اسم البنك</td>
      </tr>
      <tr>
        <td class="center">Account No</td>
        <td class="ltr">{{ $company->bank_account_number }}</td>
        <td class="rtl">{{ $company->arabic_bank_account_number }}</td>
        <td class="rtl">رقم البنك</td>
      </tr>
      <tr>
        <td class="center">IBAN</td>
        <td class="ltr">{{ $company->iban }}</td>
        <td class="rtl">{{ $company->arabic_iban }}</td>
        <td class="rtl">رقم الآيبان</td>
      </tr>
      <tr>
        <td class="center">Swift Code</td>
        <td colspan="2" class="center ltr">{{ $company->bank_swift_code }}</td>
        <td class="rtl">رمز السرعة</td>
      </tr>
    </table>

    <!-- Signature + QR -->
    <table>
      <tr>
        <th>المعد | Invoice Prepared by</th>
        <th>QR Code</th>
        <th>Invoice received by | المستقبل</th>
      </tr>
      <tr>
        <td class="center" style="vertical-align: bottom;">Signature / Stamp</td>
        <td class="center">
          <!-- Optional QR placeholder -->
          <div style="width:120px;height:120px;border:1px dashed #bbb;margin:0 auto;"> <img width="120px" height="120px" src="{{ $qrcode }}" alt="QR Code" /></div>
        </td>
        <td class="center" style="vertical-align: bottom;">Signature / Stamp</td>
      </tr>
    </table>

  </main>
</body>
</html>

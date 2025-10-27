<!DOCTYPE html>
<html ang="ar">
<head>
    <meta charset='utf-8'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  
  <title>فاتورة ضريبية / VAT INVOICE - SI-103</title>
  <style>

  

html, body, table, td, th {
  font-family: DejaVu Sans, sans-serif;
  
 
}


/* Dompdf page box margins (apply to every page) */
@page {
  margin: 1.5in 0.5in 0.5in 0.5in;
}
header{
        position: fixed;
        left: 0px;
        right: 0px;
        height: 60px;
        margin-top: -60px;
      }

/* Important: do NOT override top margin with body margin 0 */
html, body {
  background: #fff !important;
  
  margin: 0 auto;
  padding: 150px 20px 25px;
  background: var(--bg); 
  direction: rtl;
  font-size: 11px;
  
  
}

/* Add transparent offset inside body to preserve top margin on continuation pages */
body::before {
  content: "";
  display: block;
  height: 1.5in;
  margin-top: -1.5in;
}

    :root {
      --accent: #0a5aa1;
      --text: #222;
      --muted: #666;
      --border: #ddd;
      --bg: #fff;
    }

    * { box-sizing: border-box; }
   


    .header {
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 12px;
      align-items: center;
      border-bottom: 3px solid var(--accent);
      padding-bottom: 12px;
    }
    .title {
      display: flex; flex-direction: column; gap: 4px;
    }
    .title h1 {
      margin: 0; font-size: 22px; font-weight: 700; color: #fff;
      text-align: center;
      background-color: #043670ff;
    }
    .title .subtitle { font-size: 13px; color: var(--muted); text-align: center; }
    .invoice-meta {
      text-align: left; direction: ltr; font-size: 13px; color: var(--text);
    }
    .invoice-meta .no { font-weight: 600; color: var(--accent); }

    h2.section-title {
      margin: 18px 0 8px; font-size: 13px; color: var(--accent);
      border-bottom: 1px dashed var(--border); padding-bottom: 6px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 8px 0 16px;
      background: #fff;
    }
    th, td {
      border: 1px solid var(--border);
      padding: 5px 10px;
      vertical-align: middle;
      font-size: 11px;
    }
    th {
      background: #043670ff;
      color: #ffffffff;
      font-weight: 600;
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
    .muted { color: var(--muted); }
    .nowrap { white-space: nowrap; }

    .items th, .totals th { font-size: 13px; }
    .items td { font-size: 13px; }
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

    .page-break {
  page-break-before: always;
  margin: 0;
  border: none;
  height: 0;
}


  </style>
</head>
<body>
<header>
     <br>
    </header>
  <div class="container">

    <!-- Header -->
    <div class="header">
      <div class="title">
        <h1>VAT INVOICE /  فاتورة ضريبة القيمة المضافة </h1>
      </div>
      <div class="invoice-meta">
        <div><span class="no">No:</span> SI-103</div>
        <div class="muted rtl">رقم الفاتورة: ١٠٣-SI</div>
      </div>
    </div>

    <!-- From -->
    <table style="table-layout: fixed;">

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
      <tr>
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
      
      @endforeach
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
    <h2 class="section-title">تفاصيل البنك / Bank details</h2>
    <table class="bank" style="table-layout: fixed;">
      <tr>
        <th></th>
        <th colspan="3">BANK DETAILS</th>
      </tr>
      <tr>
        <td class="center">Account Name</td>
        <td class="ltr">MAKKI BIN MOHAMMED BIN MAKKI ALABBADI CONTRACTING EST.</td>
        <td class="rtl">مؤسسة مكي بن محمد العبادي للمقاولات العامة</td>
        <td class="center">اسم الحساب</td>
      </tr>
      <tr>
        <td class="center">Bank Name</td>
        <td class="ltr">ALRAJHI BANK</td>
        <td class="rtl">بنك الراجحي</td>
        <td class="center">اسم البنك</td>
      </tr>
      <tr>
        <td class="center">Account No</td>
        <td class="ltr">172000010006086231716</td>
        <td class="rtl">١٧٢٠٠٠٠١٠٠٠٦٠٨٦٢٣١٧١٦</td>
        <td class="center">رقم البنك</td>
      </tr>
      <tr>
        <td class="center">IBAN</td>
        <td class="ltr">SA8380000172608016231716</td>
        <td class="rtl">SA٨٣٨٠٠٠٠١٧٢٦٠٨٠١٦٢٣١٧١٦</td>
        <td class="center">رقم الآيبان</td>
      </tr>
      <tr>
        <td class="center">Swift Code</td>
        <td colspan="2" class="center ltr">RJHISARI</td>
        <td class="center">رمز السرعة</td>
      </tr>
    </table>

    

    <!-- Signatures -->

    <table>
      <tr>
        <th>المعد | Invoice Prepared by</th>
        <th>QR Code</th>
        <th>Invoice received by | المستقبل</th>
      </tr>
      <tr>
        <td class="center">Signature / Stamp</td>
        <td class="center">
          <!-- Optional QR placeholder -->
          <div style="width:120px;height:120px;border:1px dashed #bbb;margin:0 auto;"> <img width="120px" height="120px" src="{{ $qrcode }}" alt="QR Code" /></div>
        </td>
        <td class="center">Signature / Stamp</td>
      </tr>
    </table>

  </div>

</body>
</html>

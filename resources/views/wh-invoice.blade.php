<!DOCTYPE html>
<html lang="ar" >
<head>
  <meta charset='utf-8'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  
  <title>فاتورة ضريبية / VAT INVOICE - SI-103</title>
  <style>
    @page {
        /*to get full page */
        margin:0;
        text-align: center;
        margin-bottom:0px;
    }
    :root {
      --accent: #0a5aa1;
      --text: #222;
      --muted: #666;
      --border: #ddd;
      --bg: #fff;
    }

    * { box-sizing: border-box; }
    html, body {
    margin: 0 !important;
    padding: 0 !important;
    background: #fff !important;
}
 .container { 
  max-width: 980px; 
  margin: 0 auto;
  padding: 10px 20px;
  background: var(--bg); 
  border: none;
  border-radius: 0;
}

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
      margin: 0; font-size: 22px; font-weight: 700; color: var(--accent);
    }
    .title .subtitle { font-size: 14px; color: var(--muted); }
    .invoice-meta {
      text-align: left; direction: ltr; font-size: 14px; color: var(--text);
    }
    .invoice-meta .no { font-weight: 600; color: var(--accent); }

    h2.section-title {
      margin: 18px 0 8px; font-size: 16px; color: var(--accent);
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
      font-size: 14px;
    }
    th {
      background: #eef6ff;
      color: #073e73;
      font-weight: 600;
      text-align: center;
    }
    td { color: var(--text); }
    .ltr { direction: ltr; text-align: left; }
    .rtl { direction: rtl; text-align: right; }
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

  <div class="container">

    <!-- Header -->
    <div class="header">
      <div class="title">
        <h1>فاتورة ضريبية / VAT INVOICE</h1>
        <div class="subtitle">Invoice</div>
      </div>
      <div class="invoice-meta">
        <div><span class="no">No:</span> SI-103</div>
        <div class="muted rtl">رقم الفاتورة: ١٠٣-SI</div>
      </div>
    </div>

    <!-- From -->
    <table style="table-layout: fixed;">

      <tr>
        <td class="ltr">From: MAKKI BIN MOHAMMED BIN MAKKI ALABBADI
CONTRACTING EST.</td>
        <td class="rtl">حسب: </td>
        

      </tr>
      <tr>
        <td class="ltr">Address: Dammam, Al-Adamah District , Kingdom of Saudi
Arabia</td>
        <td class="rtl">عنوان: </td>
        
      </tr>
      <tr>
        <td class="ltr">VAT: 300468685700003</td>
        <td class="rtl">قيمة ارتفاع الضرائب:</td>
        

      </tr>

      <tr>
        <td class="ltr">CR No: 300468685700003</td>
        <td class="rtl">رقم السجل التجاري: </td>
        

      </tr>
    </table>

    <!-- To -->

    <table style="table-layout: fixed;">
      <tr>
        <td class="ltr">To: The Fundamental Installation For Electric</td>
        <td class="rtl">إلى: </td>
        

      </tr>
      <tr>
        <td class="ltr">Address: Dammam, Al-Adamah District , Kingdom of Saudi
Arabia</td>
        <td class="rtl">عنوان: </td>
        
      </tr>
      <tr>
        <td class="ltr">VAT: 300468685700003</td>
        <td class="rtl">قيمة ارتفاع الضرائب:</td>
        

      </tr>

      <tr>
        <td class="ltr">CR No: 300468685700003</td>
        <td class="rtl">رقم السجل التجاري: </td>
        

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
        <td class="center">21-08-2025</td>
        <td class="center">20-09-2025</td>
        <td class="center">MAKKI 2025</td>
        <td class="center">20-10-2025</td>
        <td class="center">21-AUG TO 20-SEP-2025</td>
        <td class="center">J0223 KSP # MAKKI</td>
      </tr>
    </table>

    <!-- Items -->

    <table class="items">
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
      <tr>
        <td class="money">9,894.60</td>
        <td class="money">1,290.60</td>
        <td class="center">15.00</td>
        <td class="money">8,604.00</td>
        <td class="money">18.00</td>
        <td class="center">478</td>
        <td class="center">Hrs</td>
        <td class="rtl">DUCT MAN / رجل القناة</td>
        <td class="center">J0231</td>
        <td class="center">1</td>
      </tr>
      <tr>
        <td class="money">1,587.00</td>
        <td class="money">207.00</td>
        <td class="center">15.00</td>
        <td class="money">1,380.00</td>
        <td class="money">23.00</td>
        <td class="center">60</td>
        <td class="center">Hrs</td>
        <td class="rtl">Electrician Foreman / رئيس عمال الكهرباء</td>
        <td class="center">MMC # J0231</td>
        <td class="center">2</td>
      </tr>
      <tr>
        <td class="money">25,916.40</td>
        <td class="money">3,380.40</td>
        <td class="center">15.00</td>
        <td class="money">22,536.00</td>
        <td class="money">18.00</td>
        <td class="center">1252</td>
        <td class="center">Hrs</td>
        <td class="rtl">ELECTRICIAN / کھربائي</td>
        <td class="center">J209</td>
        <td class="center">3</td>
      </tr>
      <tr>
        <td class="money">11,753.00</td>
        <td class="money">1,533.00</td>
        <td class="center">15.00</td>
        <td class="money">10,220.00</td>
        <td class="money">14.00</td>
        <td class="center">730</td>
        <td class="center">Hrs</td>
        <td class="rtl">HELPER / المساعد</td>
        <td class="center">MMC # J0231</td>
        <td class="center">4</td>
      </tr>
      <tr>
        <td class="money">24,012.00</td>
        <td class="money">3,132.00</td>
        <td class="center">15.00</td>
        <td class="money">20,880.00</td>
        <td class="money">18.00</td>
        <td class="center">1160</td>
        <td class="center">Hrs</td>
        <td class="rtl">PIPE FITTER / عامل تركيب الأنابيب</td>
        <td class="center">MMC # J0223</td>
        <td class="center">5</td>
      </tr>
      <tr>
        <td class="money">3,726.00</td>
        <td class="money">486.00</td>
        <td class="center">15.00</td>
        <td class="money">3,240.00</td>
        <td class="money">18.00</td>
        <td class="center">180</td>
        <td class="center">Hrs</td>
        <td class="rtl">Plumber / سباك</td>
        <td class="center">mmc # J0231</td>
        <td class="center">6</td>
      </tr>
      <tr>
        <td class="money">1,104.00</td>
        <td class="money">144.00</td>
        <td class="center">15.00</td>
        <td class="money">960.00</td>
        <td class="money">24.00</td>
        <td class="center">40</td>
        <td class="center">Hrs</td>
        <td class="rtl">MULTI WELDER / آلة لحام متعددة</td>
        <td class="center">MMC # J0223</td>
        <td class="center">7</td>
      </tr>
    </table>

    <!-- Totals -->

    <table class="totals" style="table-layout: fixed;">
      <tr class="accent-row">
        <td class="rtl"><strong>المجموع ر.س:</strong> 67,820.00 SAR</td>
        <td class="rtl"><strong>القيمة المضافة (%15):</strong> 10,173.00 SAR</td>
      </tr>
      <tr>
        <td class="rtl"><strong>المبلغ الإجمالي:</strong> 77,993.00 SAR</td>
        <td class="rtl"><strong>الرصيد المستحق:</strong> 77,993.00 SAR</td>
      </tr>
      <tr>
        <td class="ltr"><strong>Amount in words:</strong> Seventy Seven Thousand Nine Hundred Ninety Three Saudi Riyals only</td>
        <td class="rtl"><strong>المبلغ كتابياً:</strong> فقط سبعة وسبعون ألفاً وتسعمائة وثلاثة وتسعون ريالاً سعودياً لا غير</td>
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

<!DOCTYPE html>
<html lang="ar">
<head>
    <title>اختبار انشاء ملفات باللغة العربية</title>
    <meta charset='utf-8'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
    @page {
        /*to get full page */
        margin:0;
        text-align: center;
    }
    body {
        background-color: #f0f0f0;
    }
    h1 {
        color: #333;
        text-align: center;
    }
    p {
        color: #666;
        text-align: center;
    }
    .text-center {
        text-align: center;
    }
    ul { list-style-type: none; padding-left: 20px; }
    img { max-width: 100%; height: auto; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
</style>
</head>
<body>
<div class="container">
    <h1 class="text-center">مرحباً بالعالم</h1>
    <p class="mb-3">هذا ملف PDF تجريبي تم إنشاؤه باستخدام  Gpdf.</p>
    <p class="mb-3"> مرحبا , هذا اختبار لطريقة عرض الأرقام العربية  1234 </p>

    <h2>تم بناء باكج جي بي دي اف لحل مشكلة المطورين العرب   </h2>
    <h2> في التعامل مع ملفات ال بي دي اف ذات المحتوى العربي  </h2>

    <p class="mb-3">يحتوي ملف PDF هذا على محتوى HTML منسق.</p>
    <p class="mb-3">يمكنك إضافة المزيد من المحتوى هنا، مثل الصور والجداول والقوائم.</p>

    <hr class="mb-3 mt-3">

    <h2> محتوى ديناميكي  </h2>

    <div class="container">
        
    </div>

    <hr class="mb-3 mt-3">

    <p class="mb-3">يعرض هذا المستند قدرات Dompdf في إنشاء محتوى PDF غني.</p>

    <ul class="mb-3">
        <li>عنصر قائمة 1</li>
        <li>عنصر قائمة 2</li>
        <li>عنصر قائمة 3</li>
    </ul>

    <table class="mb-3">
        <thead>
        <tr>
            <th>رأس الجدول 1</th>
            <th>رأس الجدول 2</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>بيانات 1</td>
            <td>بيانات 2</td>
        </tr>
        </tbody>
    </table>

    {{ toArabicIndicDigits($sale->customer->arabic_vat_no) }} ۳۱۰۰٥۹۹۷۹۹۰۰۰۰۳ :قيمة ارتفاع الضرائب 

    <hr class="mb-3 mt-3">

   

    <hr class="mb-3 mt-3">

    <p>استمتع بتجربة Gpdf !</p>

</div>
</body>
</html>
<?php

if (! function_exists('toArabicIndicDigits')) {
    /**
     * Convert Western digits (0-9) to Arabic-Indic digits (٠-٩)
     */
    function toArabicIndicDigits($number)
    {
        $digits = [
            '0' => '٠', '1' => '١', '2' => '٢', '3' => '٣', '4' => '٤',
            '5' => '٥', '6' => '٦', '7' => '٧', '8' => '٨', '9' => '٩',
            '۰' => '٠', '۱' => '١', '۲' => '٢', '۳' => '٣', '۴' => '٤',
            '۵' => '٥', '۶' => '٦', '۷' => '٧', '۸' => '٨', '۹' => '٩',
        ];

        return strtr($number, $digits);
    }
}

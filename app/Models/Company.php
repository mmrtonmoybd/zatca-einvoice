<?php

namespace App\Models;

use App\Traits\BelongsToTeam;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use BelongsToTeam;

    protected $fillable = [
        'team_id', 'name', 'arabic_name', 'address', 'arabic_address', 'vat_number', 'arabic_vat_number', 'cr_no', 'arabic_cr_no', 'bank_name', 'arabic_bank_name', 'bank_account_number', 'arabic_bank_account_number', 'iban', 'arabic_iban', 'bank_swift_code', 'arabic_bank_account_name', 'bank_account_name', 'logo',

    ];
}

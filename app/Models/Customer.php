<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTeam;

class Customer extends Model
{
    use BelongsToTeam;
    protected $fillable = [
        'team_id', 'name', 'display_name', 'arabic_name','address', 'arabic_address', 'code', 'phone','mobile', 'email', 'vat_no', 'cr_no','contact_person', 'file', 'is_active', 
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

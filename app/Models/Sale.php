<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTeam;

class Sale extends Model
{ 
    use BelongsToTeam;
    protected $fillable = [
        'team_id', 'bill_number', 'date', 'narration', 'customer_id','type', 'po_eference', 
        'delivery_date', 'dn_reference', 'due_date','is_vat', 'payment_terms', 'invoice_period',
        'project_reference', 'total_product_discount','total_cash_discount', 'products', 'file', 'is_active', 'final_total_amount', 'final_total_tax', 'grand_total',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_vat' => 'boolean',
        'products' => 'array',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}

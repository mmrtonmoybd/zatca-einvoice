<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTeam;

class Product extends Model
{
     use BelongsToTeam;
    protected $fillable = [
        'image', 'team_id', 'unit_id','category_id','name','arabic_name','code','description','pruchase_price','sale_price', 'is_taxable',
        'tax_rate','minimum_stock_level','maximum_stock_level','mrpc','is_multi_unit','multi_units','remarks', 'element_used','hsnCode','avg_quantity','low_stock_alert','is_active',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    protected function casts(): array 
    {
        return [
            'is_active' => 'boolean',
            'is_taxable' => 'boolean',
            'is_multi_unit' => 'boolean',
            'low_stock_alert' => 'boolean',
            'multi_units' =>  'array',
        ];
    }
}

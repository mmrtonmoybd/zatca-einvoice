<?php

namespace App\Models;

use App\Traits\BelongsToTeam;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use BelongsToTeam;

    protected $fillable = [
        'team_id', 'name', 'short_name', 'arabic_name', 'quantity', 'is_active', 'is_child', 'unit_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_child' => 'boolean',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

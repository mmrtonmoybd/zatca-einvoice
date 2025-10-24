<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTeam;

class Category extends Model
{
    use BelongsToTeam;

    protected $fillable = [
        'name', 'description', 'is_active', 'team_id'
    ];

    protected function casts(): array 
    {
        return [
            'is_active' => 'boolean',
        ];
    }

}

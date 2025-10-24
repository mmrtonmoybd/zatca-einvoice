<?php

namespace App\Traits;

use Filament\Facades\Filament;
//

trait BelongsToTeam
{
    protected static function bootBelongsToTeam()
    {
        static::saving(function ($model) {
            if (! $model->team_id && Filament::getTenant()) {
                $model->team_id = Filament::getTenant()->id;
            }
        });
    }

    public function team()
    {
        return $this->belongsTo(\App\Models\Team::class);
    }
}

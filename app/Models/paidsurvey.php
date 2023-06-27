<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paidsurvey extends Model
{
    use HasFactory;

     /**
     * Get the user that owns the survey
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function survey()
    {
        return $this->belongsTo(survey::class, 'marketsurvey_id', 'id');
    }
}

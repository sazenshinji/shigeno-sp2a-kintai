<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AfterCorrection extends Model
{
    use HasFactory;

    protected $fillable = [
        'correction_id',
        'after_work_date',
        'after_clock_in',
        'after_clock_out',
    ];

    protected $casts = [
        'after_work_date' => 'date',
        'after_clock_in'  => 'datetime',
        'after_clock_out' => 'datetime',
    ];

    public function correction()
    {
        return $this->belongsTo(Correction::class);
    }

    public function afterBreaks()
    {
        return $this->hasMany(AfterBreak::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BeforeCorrection extends Model
{
    use HasFactory;

    protected $fillable = [
        'correction_id',
        'before_work_date',
        'before_clock_in',
        'before_clock_out',
    ];

    protected $casts = [
        'before_work_date' => 'date',
        'before_clock_in'  => 'datetime',
        'before_clock_out' => 'datetime',
    ];

    public function correction()
    {
        return $this->belongsTo(Correction::class);
    }

    public function beforeBreaks()
    {
        return $this->hasMany(BeforeBreak::class);
    }
}

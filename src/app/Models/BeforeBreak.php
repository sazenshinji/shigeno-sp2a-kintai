<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BeforeBreak extends Model
{
    use HasFactory;

    protected $fillable = [
        'before_correction_id',
        'break_index',
        'before_break_start',
        'before_break_end',
    ];

    protected $casts = [
        'before_break_start' => 'datetime',
        'before_break_end'   => 'datetime',
    ];

    public function beforeCorrection()
    {
        return $this->belongsTo(BeforeCorrection::class);
    }
}

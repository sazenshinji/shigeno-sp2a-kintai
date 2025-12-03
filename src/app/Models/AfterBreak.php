<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AfterBreak extends Model
{
    use HasFactory;

    protected $fillable = [
        'aftercorrection_id',
        'break_index',
        'after_break_start',
        'after_break_end',
    ];

    protected $casts = [
        'after_break_start' => 'datetime',
        'after_break_end'   => 'datetime',
    ];

    public function afterCorrection()
    {
        return $this->belongsTo(AfterCorrection::class);
    }
}

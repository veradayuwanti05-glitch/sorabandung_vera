<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    protected $fillable = [
        'report_id',
        'description',
        'image_after',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
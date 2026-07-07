<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

   protected $fillable = [
    'user_id',
    'district_id',
    'title',
    'description',
    'status',
    'priority', // Tambahkan ini
    'image_before',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function resolution()
    {
        return $this->hasOne(Resolution::class);
    }
}
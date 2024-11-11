<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'packagetoursfk',
    ];

    public function tour()
    {
        return $this->belongsTo(PackageTour::class, 'packagetoursfk');
    }
}

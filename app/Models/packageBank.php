<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class packageBank extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'bankname',
        'bankaccountname',
        'bankaccountnumber',
        'logo'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($packageBank) {
            if ($packageBank->logo) {
                Storage::delete($packageBank->logo);
            }
        });

        static::updating(function ($packageBank) {
            if ($packageBank->isDirty('logo')) {
                Storage::delete($packageBank->getOriginal('logo'));
            }
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class packagePhoto extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'packagetoursfk',
        'photo',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($packagePhoto) {
            if ($packagePhoto->photo) {
                Storage::delete($packagePhoto->photo);
            }
        });

        static::updating(function ($packagePhoto) {
            if ($packagePhoto->isDirty('photo')) {
                Storage::delete($packagePhoto->getOriginal('photo'));
            }
        });
    }
}

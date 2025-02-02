<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    public function tours()
    {
        return $this->hasMany(PackageTour::class, 'citiesfk');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($city) {
            if ($city->image) {
                Storage::delete($city->image);
            }
        });

        static::updating(function ($city) {
            if ($city->isDirty('image')) {
                Storage::delete($city->getOriginal('image'));
            }
        });
    }
}

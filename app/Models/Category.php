<?php

namespace App\Models;

use App\Models\PackageTour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    public function tours()
    {
        return $this->hasMany(PackageTour::class, 'categoriesfk');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            if ($category->icon) {
                Storage::delete($category->icon);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('icon')) {
                Storage::delete($category->getOriginal('icon'));
            }
        });
    }
}

<?php

namespace App\Models;

use App\Models\Category;
use App\Models\PackagePhoto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class PackageTour extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'categoriesfk',
        'citiesfk',
        'thumbnail',
        'price',
        'location',
        'about',
        'days',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoriesfk');
    }

    public function photos()
    {
        return $this->hasMany(PackagePhoto::class, 'packagetoursfk', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'citiesfk');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($packageTour) {
            if ($packageTour->thumbnail) {
                Storage::delete($packageTour->thumbnail);
            }

            foreach ($packageTour->photos as $photo) {
                if ($photo->photo) {
                    Storage::delete($photo->photo);
                }
                $photo->delete();
            }
        });

        static::updating(function ($packageTour) {
            if ($packageTour->isDirty('thumbnail')) {
                Storage::delete($packageTour->getOriginal('thumbnail'));
            }
        });
    }
}
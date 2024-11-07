<?php

namespace App\Models;

use App\Models\PackageTour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->hasMany(PackageTour::class);
    }
}

<?php

namespace App\Models;

use App\Models\User;
use App\Models\packageBank;
use App\Models\PackageTour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class packageBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'proof',
        'usersfk',
        'packagetoursfk',
        'packagebanksfk',
        'quantity',
        'totalamount',
        'insurance',
        'tax',
        'subtotal',
        'ispaid',
        'startdate',
        'enddate',
    ];

    protected $casts = [
        'startdate' => 'datetime',
        'enddate' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'usersfk');
    }

    public function tour()
    {
        return $this->belongsTo(PackageTour::class, 'packagetoursfk');
    }

    public function bank()
    {
        return $this->belongsTo(packageBank::class, 'packagebanksfk');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($packageBooking) {
            if ($packageBooking->proof) {
                Storage::delete($packageBooking->proof);
            }
        });

        static::updating(function ($packageBooking) {
            if ($packageBooking->isDirty('proof')) {
                Storage::delete($packageBooking->getOriginal('proof'));
            }
        });
    }
}

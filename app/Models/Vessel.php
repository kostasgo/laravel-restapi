<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'imo_number'];

    public function voyages() {
        return $this->hasMany(Voyage::class);
    }

    public function operational_expenses() {
        return $this->hasMany(VesselOpex::class);
    }
}

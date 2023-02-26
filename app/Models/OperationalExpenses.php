<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationalExpenses extends Model
{
    use HasFactory;

    public function vessel() {
        return $this->BelongsTo(Vessel::class);
    }
}

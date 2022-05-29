<?php

namespace App\Models;

use App\Enums\tableStatus;
use App\Enums\tableLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'guestNumber', 'status', 'location'];

    protected $casts = [
          'status' => tableStatus::class,
          'location' => tableLocation::class,
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

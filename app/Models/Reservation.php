<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phone',
        'table_id',
        'resTime',
        'guestNumber',
    ];

    protected $dates = [
        'resTime'
    ];

    public function getresTime()
    {
        return $this->resTime->isoFormat('LLLL');
    }

    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
}

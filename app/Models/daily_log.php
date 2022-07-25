<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daily_log extends Model
{
    use HasFactory;

    protected $table = "daily_log";

    protected $fillable = ['plate_vehicle', 'check_in', 'check_out', 'duration', 'paid', 'total_pay'];

    protected $hidden = ['id'];

    public $timestamps = false;
}

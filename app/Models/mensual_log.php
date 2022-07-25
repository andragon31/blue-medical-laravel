<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mensual_log extends Model
{
    use HasFactory;

    protected $table = "mensual_log";

    protected $fillable = ['start_date', 'finish_date', 'total_min', 'total_pay'];

    protected $hidden = ['id'];

    public $timestamps = false;
}

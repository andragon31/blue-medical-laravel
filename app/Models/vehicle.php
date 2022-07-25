<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\contract;

class vehicle extends Model
{
    use HasFactory;

    protected $table = "vehicle";

    protected $fillable = ['plate', 'id_contract', 'state', 'created_at'];

    public $timestamps = false;

}

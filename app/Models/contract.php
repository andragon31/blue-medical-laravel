<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\vehicle;

class contract extends Model
{
    use HasFactory;

    protected $table = "contract";

    protected $fillable = ['id','contract', 'price', 'state', 'created_at'];

    protected $hidden = [];

    public $timestamps = false;

    //relacion uno a uno
    public function vehicles(){
        return $this->hasOne(vehicle::class, 'id_contract');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\ShipDivision;
// use App\Models\shipDistrict;


class ShipState extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function division(){
        return $this->belongsTo(ShipDivision::class,'division_id','id');
    } // End Method


    public function district(){
        return $this->belongsTo(shipDistrict::class,'district_id','id');
    } // End Method


}

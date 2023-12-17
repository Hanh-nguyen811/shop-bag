<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['name','id_brand','status'];
    protected $table = "types";
    public function brands()
    {
        return $this->belongsTo(Brand::class,'id_brand','id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'id_type','id');
    }
}

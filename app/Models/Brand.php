<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name','status'];
    protected $table = "Brands";
    public function types(){
        return $this ->hasMany(Type::class,'id_brand','id');
    }
    public function products(){
        return $this ->hasManyThrough(Type::class,Product::class,'id_brand','id_type','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','description','content','id_brand',
        'id_type','price','id_menu','status','image'
    ];
    protected $table = "Products";
    public function brands()
    {
        return $this->belongsTo(Brand::class,'id_brand','id');
    }
    public function types()
    {
        return $this->belongsTo(Type::class,'id_type','id');
    }
}

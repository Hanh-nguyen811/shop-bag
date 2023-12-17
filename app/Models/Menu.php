<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name','parent_id','status'];
    protected $table = "menus";
    public function menuChildrent(){
        return $this ->hasMany(Menu::class,'parent_id');
    }
}

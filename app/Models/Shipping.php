<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $table = "shippings";


    protected $fillable = [
        'name',
        'phone',
        'address',
        'email',
        'note'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoices::class, 'id_shipping', 'id');
    }
}


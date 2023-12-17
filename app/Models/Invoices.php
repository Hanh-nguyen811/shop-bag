<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_shipping',
        'id_customer',
        'date',
        'payment_id',
        'status'
            
    ];
    protected $table = "Invoices";


    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'id_product');
    }

    public function shippings()
    {
        return $this->belongsTo(Shipping::class, 'id_shipping', 'id');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }


    public function payments()
    {
        return $this->hasMany(Payment::class, 'paymnet_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $table = "invoice_details";


    protected $fillable = [
       'id_invoice ',
       'id_product',
       'price ',
       'quantity '
    ];

    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'id_product');
    }
}



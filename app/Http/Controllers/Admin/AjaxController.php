<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Invoice;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    public function getAjax($id){
        $types = Type::where('id_brand',$id)->get();
        foreach($types as $type){
            echo "<option value='".$type->id."'>".$type->name."</option>";

        }
    }

}
?>
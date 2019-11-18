<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function getProductInfo(Request $request) 
    {
    	$data = Product::find($request->id);

    	return $data;
    }
}

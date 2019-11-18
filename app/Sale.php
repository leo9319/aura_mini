<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    public function productSales()
    {
    	return $this->hasMany('App\ProductSale');
    }

    public function deliveryCompany()
    {
    	return $this->belongsTo('App\DeliveryCompany');
    }

    public function getTotal()
    {
    	return $this->hasMany('App\ProductSale')->sum(\DB::raw('product_sales.mrp * product_sales.quantity'));
    }

    public function getTotalWithDeliveryCharge()
    {
    	return ($this->getTotal() + $this->deliveryCompany->rate);
    }

}

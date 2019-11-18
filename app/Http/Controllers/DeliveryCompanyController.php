<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeliveryCompany;

class DeliveryCompanyController extends Controller
{
    public function getCompanyZone(Request $request) 
    {
    	$data = DeliveryCompany::where('company_name_id', $request->company_name_id)
		    	->where('district_id', $request->company_district_id)
		    	->get();

    	return $data;
    }
}

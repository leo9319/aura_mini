<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\District;
use App\DeliveryCompany;
use App\Sale;
use App\ProductSale;
use DB;

class SaleController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
    	$data['sales'] = Sale::all();

    	return view('sales.index', $data);
    }

    public function create() 
    {
        $data['products']          = Product::all();
        $data['company_names']     = DB::table('company_names')->get();
        $data['company_districts'] = District::all();

        return view('sales.create', $data);
    }

    public function store(Request $request) 
    {
        $validatedData = $request->validate([
                'date'    => 'required',
                'name'    => 'required',
                'phone'   => 'required',
                'delivery_company_id'   => 'required',
                'product_id'   => 'required',
            ],
            [
                'delivery_company_id.required' => 'Please select the delivery zone correctly',
            ]
        );

        $sale = Sale::create([
            'delivery_company_id' => $request->delivery_company_id,
            'date' => $request->date,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        $product_ids = $request->product_id;

        foreach ($product_ids as $index => $product_id) {
            ProductSale::create([
                'sale_id' => $sale->id,
                'product_id' => $product_id,
                'quantity' => $request->quantity[$index],
                'mrp' => $request->mrp[$index],
            ]);
        }

        return redirect()->route('sales.show', ['sale' => $sale->id]);

    }

    public function show(Sale $sale)
    {
        $data['sale'] = $sale;
        $data['pages'] = 1;

        return view('sales.show', $data);
    }
}

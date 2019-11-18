<!DOCTYPE html>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />	
	<title>Customer Invoice</title>
	<link rel='stylesheet' type='text/css' href="{{asset('css/style.css')}}" />
	<link rel='stylesheet' type='text/css' href="{{asset('css/print.css')}}" media="print" />
	<script type='text/javascript' src="{{asset('js/jquery-1.3.2.min.js')}}"></script>
	<script type='text/javascript' src="{{asset('js/example.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">

</head>
<body>
	<div id="page-wrap">
		<div id="header">INVOICE</div>

		<div id="identity">
        <div id="address">
        	<div id="company-name">Purple Algorithm Ltd.</div> 
        	<div>Baridhara DOHS</div> 
        	<div>Road No. 10, House# 516 (2nd Floor)</div> 
        	<div>Dhaka-1212, Bangladesh</div>
		</div>
			<div id="logo">
				<img src="{{asset('images/logo.png')}}" alt="logo" height="115" width="115"/>
			</div>
		</div>
		
		<div style="clear:both"></div>

		<div class="row">
			<div class="col-md-6">
				<table class="borderless">
				  <tr>
				    <td class="text-right font-weight-bold">To:</td>
				    <td>{{ $sale->name }}</td> 
				  </tr>
				  <tr>
				    <td class="text-right font-weight-bold">Address:</td>
				    <td>{{ $sale->address }}</td>
				  </tr>
				  <tr>
				    <td class="text-right font-weight-bold">Phone:</td>
				    <td>{{ $sale->phone }}</td>
				  </tr>
				  <tr>
				    <td class="text-right font-weight-bold">Email:</td>
				    <td>{{ $sale->email }}</td>
				  </tr>
				</table>
			</div>
			<div class="col-md-6">
				<table id="meta">
					<tr>
	                    <td class="meta-head">Date</td>
	                    <td>{{ $sale->date }}</td>
	                </tr>
	                <tr>
	                    <td class="meta-head">Invoice #</td>
	                    <td>{{ 'IN' . sprintf('%06d', ($sale->id)) }}</td>
	                </tr>    
            	</table>
			</div>	
		</div>
		
		<table id="items">
			<tr>
				<th>SL.</th>
				<th>Product Name</th>
				<th>Product Code</th>
				<th>Quantity</th>
				<th>Rate</th>
				<th>Total</th>
			</tr>
			
			@foreach($sale->productSales as $index => $product_sale)
			<tr id="hiderow">
				<td colspan="1">{{ $index + 1 }}</td>
				<td colspan="1">{{ $product_sale->product->name }}</td>
				<td colspan="1">{{ 'P' . sprintf('%01d', ($product_sale->product->id)) }}</td>
				<td colspan="1">{{ $product_sale->quantity }}</td>
				<td colspan="1">{{ $product_sale->mrp }}</td>
				<td colspan="1">{{ $product_sale->mrp * $product_sale->quantity }}</td>
			</tr>
			@endforeach

			<tr id="hiderow">
				<td colspan="3"></td>
				<td colspan="1">Product Bill</td>
				<td colspan="1"></td>
				<td colspan="1"><b>{{ $sale->getTotal() }}</b></td>
			</tr>

			<tr id="hiderow">
				<td colspan="3"></td>
				<td colspan="1">Delivery Charge</td>
				<td colspan="1"></td>
				<td colspan="1"><b>{{ $sale->deliveryCompany->rate }}</b></td>
			</tr>

			<tr id="hiderow">
				<td colspan="3"></td>
				<td colspan="1">Total Bill</td>
				<td colspan="1"></td>
				<td colspan="1"><b>{{ $sale->getTotalWithDeliveryCharge() }}</b></td>
			</tr>

		</table>
		<div id="terms">
		  <div>If you have any questions concerning this invoice, contact us @ 01929000400.</div>
		</div>
		<div id="clearance">
			<div class="row">
				<span class="col-md-4 font-weight-bold"><u>Inventory Department</u></span>
				<span class="col-md-4 font-weight-bold"><u>Accounts Department</u></span>
				<span class="col-md-4 font-weight-bold text-right"><u>Received By</u></span>
			</div>
		</div>
	</div>

</body>
</html>
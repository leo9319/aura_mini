@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Invoice</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">

                    {{ Form::open(['route'=>'sales.store']) }}

                    <div class="form-group">

                        {{ Form::label('date') }}
                        {{ Form::date('date', Carbon\Carbon::now(), ['class'=>'form-control']) }}
                        
                    </div>

                    <div class="row">

                        <div class="col-md-6">
            
                            <div class="form-group">

                                {{ Form::label('name') }}
                                {{ Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Name', 'required']) }}
                                
                            </div>
                            
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                {{ Form::label('address') }}
                                {{ Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'Address', 'required']) }}
                                
                            </div>
                            
                        </div>
                        
                    </div>


                    <div class="row">

                        <div class="col-md-6">
            
                            <div class="form-group">

                                {{ Form::label('phone') }}
                                {{ Form::number('phone', null, ['class'=>'form-control', 'placeholder'=>'Phone', 'required']) }}
                                
                            </div>
                            
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                {{ Form::label('email') }}
                                {{ Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) }}
                                
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="form-group">

                        {{ Form::label('company_name_id', 'Delivery Company Name') }}
                        {{ Form::select('company_name_id', $company_names->pluck('name', 'id'), null, ['id'=>'company-name-id', 'class'=>'company-name form-control', 'placeholder'=>'Select a Company Name']) }}
                        
                    </div>

                    <div class="form-group">

                        {{ Form::label('company_district_id', 'Delivery Company District') }}
                        {{ Form::select('company_district_id', $company_districts->pluck('name', 'id'), null, ['id'=>'company-district-id', 'class'=>'form-control', 'placeholder'=>'Select a District']) }}
                        
                    </div>

                    <div class="form-group">

                        {{ Form::label('delivery_company_id', 'Delivery Company Zone') }}
                        {{ Form::select('delivery_company_id', [], null, ['id'=>'company-zone', 'class'=>'form-control', 'placeholder'=>'Select a Zone', 'id'=>'zones']) }}
                        
                    </div>

                    <hr>

            
                    <div>

                        <div class="form-group">
    
                            {{ Form::label('product_id', 'Product Name') }}
                            {{ Form::select('product_id[]', $products->pluck('name', 'id'), null, ['class'=>'product form-control', 'placeholder'=>'Select a Product', 'required']) }}
                            
                        </div>
    
                        <div class="row">
    
                            <div class="col-md-6">
                
                                <div class="form-group">
    
                                    {{ Form::label('quantity') }}
                                    {{ Form::number('quantity[]', null, ['class'=>'quantity form-control', 'placeholder'=>'Quantity', 'required']) }}
                                    
                                </div>
                                
                            </div>
    
                            <div class="col-md-6">
    
                                <div class="form-group">
    
                                    {{ Form::label('mrp') }}
                                    {{ Form::text('mrp[]', null, ['class'=>'mrp form-control', 'readonly']) }}
                                    
                                </div>
                                
                            </div>
                            
                        </div>

                    </div>

                    <div id="product-container"></div>

                    <button type="button" class="add btn btn-block btn-info mt-2">Add More Product</button>

                    {{ Form::submit('Create', ['class'=>'btn btn-block btn-success']) }}

                    {{ Form::close() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>

@section('footer_scripts')

    <script type="text/javascript">

        $(document).ready(function() {

            remove();
            setPrice();
        
            $(".add").click(function() {
                
                var productHTML = `

                    <div>

                        <div>

                            <hr>
                        
                            <div class="form-group">
        
                                {{ Form::label('product_id', 'Product Name') }}
                                {{ Form::select('product_id[]', $products->pluck('name', 'id'), null, ['class'=>'product form-control', 'placeholder'=>'Select a Product', 'required']) }}
                                
                            </div>


                            <div class="row">

                                <div class="col-md-6">
                    
                                    <div class="form-group">

                                        {{ Form::label('quantity') }}
                                        {{ Form::number('quantity[]', null, ['class'=>'form-control', 'placeholder'=>'Quantity', 'required']) }}
                                        
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        {{ Form::label('mrp') }}
                                        {{ Form::text('mrp[]', null, ['class'=>'mrp form-control', 'readonly']) }}
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>

                            <button type="button" class="remove btn btn-block btn-danger mt-2">Remove This Product</button>

                            <hr>

                        </div>

                    </div>

                `;

                var productContainer = $('#product-container');

                productContainer.append(productHTML);

                remove();
                setPrice();
                
            });

        });

        $("#company-district-id").change(function() {

            var companyNameId = $("#company-name-id").val();
            var companyDistrictId = $("#company-district-id").val();
            var zones = '';

            $.ajax({
              type: 'get',
              url: '{!!URL::to('getCompanyZone')!!}',
              data: {
                'company_name_id'    : companyNameId,
                'company_district_id': companyDistrictId,
              },
              success:function(data){

                for(var i = 0; i < data.length; i++) {

                    zones += '<option value="'+data[i].id+'">'+data[i].zone+'</option>';

                }

                document.getElementById('zones').innerHTML = zones;
                     
              },
              error:function(){

              }
            }); 
            
        });

        function setPrice() {

            $(".product").change(function() {

                var mrp = $(this).parent().parent().find('.mrp');
                mrp.val('');
                var productId = $(this).val();

                $.ajax({
                  type: 'get',
                  url: '{!!URL::to('getProductInfo')!!}',
                  data: {'id': productId},
                  success:function(data){

                    mrp.val(data.mrp);
                         
                  },
                  error:function(){

                  }
                }); 
                
            });

        }

        function remove() {
            $(".remove").click(function() {
                $(this).parent().remove();
            });
        }



    </script>

@endsection
@endsection
@extends('layouts.app')

@section('header_scripts')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#sales').DataTable();
    } );
</script>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">All Invoice</div>

                <div class="card-body">

                    <table id="sales" class="align-middle mb-0 table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $sale)
                            <tr>
                                <td>{{ 'IN' . sprintf('%06d', ($sale->id)) }}</td>
                                <td>{{ $sale->date }}</td>
                                <td>{{ $sale->name }}</td>
                                <td>{{ $sale->address }}</td>
                                <td>{{ $sale->email }}</td>
                                <td>{{ $sale->phone }}</td>
                                <td><a href="{{ route('sales.show', $sale->id) }}">View</a></td>
                            </tr>
                            @endforeach()
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@section('footer_scripts')

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

@endsection

@endsection
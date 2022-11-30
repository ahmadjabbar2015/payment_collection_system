@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row ">
            <br><br>
            {{-- <div class="card  mt-5 mx-3" style="width:100%">   
                <div class="  card-body">
                    <h2 class="card-title">Filters</h2>
                    <div class="d-flex">
                        <div class="col-md-4">
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          </div>
        
                          <div class="col-md-4">
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          </div>
                    </div>
                  
                </div>
              </div> --}}
        </div>
    
        <div class="row">
            <div class="col">
            <div class="ms-2 me-2 ">
                <div>
                    <h5>Customers Due Amount Till Today</h5>
                    <table class="table mt-4" id="mytable">
                        <thead>
                            <tr>
                                
                                <th scope="col" class="">Name</th>                               
                                <th scope="col" class="">Due Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                                
                                @foreach($arr as $customers)
                                <tr> 
                                     <td>{{$customers['customer_name']}}</td> 
                                     <td>{{$customers['payment_due']}}</td>  
                                </tr>

                                @endforeach
                        </tbody>
                        <tbody>
                </div>
            </div>
            </div>
        </div>
    </div>
    @endsection
    <script src="https://code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        {{-- <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
        {{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}


@section('page-script')
<script src="{{ asset('assets/js/page_scripts/product.js') }}"></script>
@endsection

@section('custom-script')
<script>
$(document).ready(function () {
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('product.index') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'version', name: 'version'},
            {data: 'default_price', name: 'default_price'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
});
</script>
@endsection

    


@extends('layouts.app')


@section('content')


  
  <!-- Modal -->
  <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    
  </div>
    <div class="container">
        <div class="row">
            <div class="col">
            <div class="ms-2 me-2 mt-5">

                <div class="card">
                    <div class="card-header">
                        <h2>Info</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Name</h5>
                                <h5>Mobile</h5>
                                <h5>Email</h5>
                                <h5>City</h5>   
                                <h5>Country</h5>
                            </div>
                            <div class="col-md-4">
                                <h5>{{$customer->first_name}} {{$customer->last_name}}</h5>
                                <h5>{{$customer->mobile_no}}</h5>
                                <h5>{{$customer->email}}</h5>
                                <h5>{{$customer->city}}</h5>
                                <h5>{{$customer->country}}</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <table class="table mt-4 yajra-datatable" id="mytable" class="w-100 text-center">
                        <thead>
                            <tr>
                                
                                <th scope="col" class="">Prodcut</th>
                                <th scope="col" class="">Start date</th>
                                <th scope="col" class="">Total Price</th>
                                <th scope="col" class="">Amount Paid Till Date</th>
                                <th scope="col" class="">Next Payment Due</th>
                                <th scope="col" class="">Next Payment Date</th>
                                <th scope="col" class="">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="'.$row->id.'">Payments</a>
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

@endsection

    <script type="text/javascript">
      
      
    $(document).on('click', 'a.payment-btn', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            dataType: 'html',
            success: function(result) {
                $('#paymentModal')
                    .html(result)
                    .modal('show');
                
            },
        });
    });

    $(document).on('click', 'a.add-payment-btn', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            dataType: 'html',
            success: function(result) {
                $('#paymentModal')
                    .html(result)
                    .modal('show');
                
            },
        });
    });

      $(document).ready(function () {
        
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customer.show' , $customer->id) }}",
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product', name: 'product'},
                {data: 'start_date', name: 'start_date'},
                {data: 'total_amount', name: 'total_amount'},
                {data: 'amount_paid', name: 'amount_paid'},
                {data: 'next_payment', name: 'next_payment'},
                {data: 'next_payment_date', name: 'next_payment_date'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });       

      });

      $(document).on('submit', '#add-payment-form' , function(e){
        e.preventDefault();
        var fdata = new FormData(this);
        for (const value of fdata.values()) {
            console.log(value);
        }
        var url = $(this).attr('action');
        $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
                
        jQuery.ajax({
                url: url,
                type:'POST',
                contentType: false, //MUST
                processData: false, //MUST
                dataType: 'json',
                data:fdata,
                success:function(output){
                    if(output.status == 1){
                        $('#paymentModal').modal('hide');
                        $('.yajra-datatable').DataTable().ajax.reload();
                    }
                    
                }
        });
        
      });

    </script>


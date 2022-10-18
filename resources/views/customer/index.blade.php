@extends('layouts.app')


@section('content')
    <div class="container">
    <div class="row">
        <div class="col">
        <div class="ms-2 me-2 mt-5">

            <a href="{{route('customer.create')}}"> <button class="btn btn-primary mt-5 ml-3">Add
                </button></a>

            <div>
                <table class="table mt-4 yajra-datatable" id="mytable">
                    <thead>
                        <tr>
                            
                            <th scope="col" class="">First Name</th>
                            <th scope="col" class="">Last Name</th>
                            <th scope="col" class="">Mobile</th>
                            <th scope="col" class="">Email</th>
                            <th scope="col" class="">City</th>
                            <th scope="col" class="">Actions</th>
                        </tr>
                    </thead>
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

@endsection

    <script type="text/javascript">
      $(document).ready(function () {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customer.index') }}",
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'mobile_no', name: 'mobile_no'},
                {data: 'email', name: 'email'},
                {data: 'city', name: 'city'},
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


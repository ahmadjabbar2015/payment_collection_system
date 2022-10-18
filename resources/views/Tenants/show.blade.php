@extends('layouts.app')


@section('content')
    <div class="contanir">
    <div class="row">
        <div class="col">
        <div class="ms-2 me-2 mt-5">

            <a href="/tenants"> <button class="btn btn-primary mt-5 ml-3">Add
                </button></a>

            <div>
                <table class="table mt-4 yajra-datatable" id="mytable">
                    <thead>
                        <tr>
                            <th scope="col" class="">ID</th>
                            <th scope="col" class=""> Name</th>
                            <th scope="col" class="">Email</th>
                            <th scope="col" class="">Adrees</th>
                            <th scope="col" class="">#Phone</th>
                            <th scope="col" class="">Lease</th>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
      $(function () {

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('tenants.show') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'username', name: 'username'},
                {data: 'phone', name: 'phone'},
                {data: 'dob', name: 'dob'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });

    //   });
    </script>


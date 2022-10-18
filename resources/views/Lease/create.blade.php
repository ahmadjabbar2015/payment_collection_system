@extends('layouts.app')

@section('content')
{{-- saad --}}

    <div class="container">
        <form>
        <div class="row">
        <div class=" mt-6 ml-4">
            <h1>
             New Lease
            </h1>
        </div>
    </div>
    <div class="shadow -lg-3 p-3 mb-5 bg-body rounded mr-4 ml-4">
        <h4>
           Create Lease
        </h4>
        <p>Complete all the required details</p><br>
        <div class="row mt-2">
            <div class="col">
                <label>Full name</label>
                <input type="text" class="form-control" placeholder="Full name" name="full_name">
            </div>
            
        </div><br>
        <div class="row ">
            <div class="col">
                <label>Phone Number</label>
                <input type="text" class="form-control" placeholder="12321" name="number">
            </div>
            <div class="col">
                <label>Identity No/Passport</label>
                <input type="text" class="form-control" placeholder="123321" name="identity">
            </div>
        </div><br>
        <div class="row ">
            <div class="col">
                <label>Identifcation Docoument</label>
                <input type="file" name="file">
            </div>
            <div class="col">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="address" name="address">
            </div>
        </div><br>
        <div class="progress" style="height: 50px;">

            <h4 class="mt-3  ml-5"> <i class="fa fa-bookmark  "></i> PLACE OF WORK</h4>
        </div><br>
        <div class="row ">
            <div class="col">
                <label>Occupation</label>
                <input type="text" class="form-control" placeholder="   Choose" name="occupation">
            </div>
            <div class="col">
                <label>Occupation Place</label>
                <input type="text" class="form-control" placeholder="" name="place">
            </div>
        </div><br>
        <button type="button" class="btn btn-primary btn-lg ml-3">Register Tenant</button>
    </div>
</form>




        {{-- @include('layouts.footers.auth') --}}

@endsection

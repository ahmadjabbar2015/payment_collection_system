@extends('layouts.app')

@section('content')

    {{-- saad --}}

    <div class="container">
        <form method="POST" action="{{ route('customer.store') }}" enctype="">
            @csrf
        <div class="row">
        <div class=" mt-6 ml-4">
            <h1>
                Customers
            </h1>
        </div>
    </div>
    <div class="shadow -lg-3 p-3 mb-5 bg-body rounded mr-4 ml-4">
        <h4>
            Register New Customer
        </h4>
        <br>
        <div class="row mt-2">
            <div class="col-md-4 ">
                <label for="Fname">Prefix :*</label>
                <input type="text" class="form-control" required="required" placeholder="Mr. Mrs." name="prefix">
            </div>
            <div class="col-md-4">
                <label for="Fname">First Name :*</label>
                <input type="text" class="form-control" required="required" placeholder="Full name" name="first_name">
            </div>
            <div class="col-md-4">
                <label for="Fname">Last Name :*</label>
                <input type="text" class="form-control" required="required" placeholder="Full name" name="last_name">
            </div>
        </div><br>
        <div class="row ">
            <div class="col-md-4">
                <label for="email">Email :</label>
                <input type="email" class="form-control" placeholder="email" name="email">
            </div>
            <div class="col-md-4">
                <label>Phone Number :*</label>
                <input type="text" class="form-control"required="required"  placeholder="12321" name="mobile_no">
            </div>
            <div class="col-md-4">
                <label >Alternate Number</label>
                <input type="text" class="form-control" placeholder="123321" name="alt_number">
            </div>
        </div><br>
        

        <div class="row ">
            <div class="col-md-4">
                <label >Address</label>
                <input type="text" class="form-control" placeholder="address" name="address">
            </div>
            <div class="col-md-4">
                <label >City</label>
                <input type="text" class="form-control" placeholder="City" name="city">
            </div>
            <div class="col-md-4">
                <label >Country</label>
                <input type="text" class="form-control" placeholder="Country" name="country">
            </div>
        </div><br>

        <div class="row mt-2">
            <div class="col-md-6">
                <label >Business</label>
                <input type="text" class="form-control" placeholder="Country" name="country">
            </div>
            <div class="col-md-6">
                <label >Business Description</label>
                <input type="text" class="form-control" placeholder="Country" name="country">
            </div>
        </div><br>
        
        <button type="submit" class="btn btn-primary btn-lg ml-3">Save</button>
    </div>
</form>
    </div>


    {{-- @include('layouts.footers.auth') --}}
@endsection

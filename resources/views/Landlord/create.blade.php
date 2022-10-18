@extends('layouts.app')

@section('content')
{{-- saad --}}


<div class="container">
    <form>
    <div class="row">
    <div class=" mt-6 ml-4">
        <h1>
            Register  Landlord
        </h1>
    </div>
</div><br>
<div class="shadow -lg-3 p-3 mb-5 bg-body rounded mr-2 ml-2">
    <h4>
        Register New  Landlord
    </h4>
    <p>Register landlord  will be receive wellcom email with login credentiels</p><br>
    <div class="row mt-2">
        <div class="col">
            <label>Full name</label>
            <input type="text" class="form-control" placeholder="Full name" name="full_name">
        </div>
        <div class="col">
            <label>Email</label>
            <input type="text" class="form-control" placeholder="email" name="email">
        </div>
        <div class="col">
            <label>Phone Number</label>
            <input type="text" class="form-control" placeholder="12321" name="number">
        </div>
    </div><br><br>
    <div class="row ">
        <div class="col">
            <label>Identity No/Passport</label>
            <input type="text" class="form-control" placeholder="123321" name="identity">
        </div>
        <div class="col">
            <label>Identifcation Docoument</label>
            <input type="file"class="form-control" name="file">
        </div>
        
    </div><br><br>
    <div class="row ">
        <div class="col">
            <label>Address</label>
            <input type="text" class="form-control" placeholder="address" name="address">
        </div>
        <div class="col">
            <label>Bnak Associated</label>
            <input type="text" class="form-control" placeholder="" name="occupation">
        </div>
        <div class="col">
            <label>Bank Account No</label>
            <input type="text" class="form-control" placeholder="" name="account">
        </div>
    </div><br>
    <button type="button" class="btn btn-primary btn-lg ml-3">Register Landlord</button>
</div>
</form>
</div>


        {{-- @include('layouts.footers.auth') --}}

@endsection

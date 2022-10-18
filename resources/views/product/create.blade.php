@extends('layouts.app')

@section('content')

    {{-- saad --}}

    <div class="container">
        <form method="POST" action="{{ route('product.store') }}" enctype="">
            @csrf
        <div class="row">
        <div class=" mt-6 ml-4">
            <h1>
                Softwares
            </h1>
        </div>
    </div>
    <div class="shadow -lg-3 p-3 mb-5 bg-body rounded mr-4 ml-4">
        <h4>
            Add New Software
        </h4>
        <br>
        <div class="row mt-2">
            
            <div class="col-md-6">
                <label for="Fname">Name :*</label>
                <input type="text" class="form-control" required="required" placeholder="Name" name="name">
            </div>
            <div class="col-md-6">
                <label for="Fname">Version :*</label>
                <input type="text" class="form-control" required="required" placeholder="Full name" name="version">
            </div>
        </div><br>
        <div class="row ">
            <div class="col-md-6">
                <label for="email">Category :*</label>
                <input type="text" class="form-control" required="required" placeholder="category" name="category_id">
            </div>
            <div class="col-md-6">
                <label>Price :*</label>
                <input type="text" class="form-control"required="required"  placeholder="1000" name="default_price">
            </div>
            
        </div><br>
        

        
        <button type="submit" class="btn btn-primary btn-lg ml-3">Save</button>
    </div>
</form>
    </div>


    {{-- @include('layouts.footers.auth') --}}
@endsection

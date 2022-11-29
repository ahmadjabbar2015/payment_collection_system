@extends('layouts.app')

@section('content')

    {{-- saad --}}

    <div class="container">
        <form method="POST" action="{{ route('sales.store') }}" enctype="">
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
            New Sale
        </h4>
        <br>
        <div class="row mt-2">
            
            <div class="col-md-6">
                <label for="Fname">Customer :*</label>
                <select class="form-control" name="customer_id" id="customers">
                    <option selected disabled>Select An Option</option>
                    @foreach ($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}</option>
                    @endforeach
                </select>
                
            </div>
            <div class="col-md-6">
                <label for="Fname">Product :*</label>
                <select class="form-control" name="product_id" id="product">
                    <option selected disabled>Select An Option</option>
                    @foreach ($products as $product)
                        <option value="{{$product->id}}" data-price = "{{$product->default_price}}">{{$product->name}} </option>
                    @endforeach
                </select>
            </div>
        </div><br>
        <div class="row ">
            <div class="col-md-6">
                <label for="email">Price: *</label>
                <input type="number" class="form-control" required="required" placeholder="0" name="price" id="product_price" disabled>
            </div>
            <div class="col-md-6">
                <label>Advance Payment :*</label>
                <input type="number" class="form-control"required="required"  placeholder="0" name="advance_payment">
            </div>
            
        </div><br>

        <div class="row ">
            <div class="col-md-6">
                <label for="payment_cycle">Payment Cycle</label>
                <select type="number" class="form-control" required="required" placeholder="0" name="payment_cycle" id="billing_cycle" >
                    <option selected disabled>Please Select An Option</option>
                    <option value="annually">Lifetime</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div> 
            <div class="col-md-6">
                <label for="payment_method">Payment Method</label>
                <select type="number" class="form-control" required="required" placeholder="0" name="payment_method" id="billing_cycle" >
                    <option disabled>Please Select An Option</option>
                    <option value="cash" selected>Cash</option>
                    <option value="card">Card</option>
                </select>
            </div>                       
                                   
        </div><br>

        <div class="row ">
            <div class="col-md-6">
                <label for="date">Date</label>
                <input type="date" class="form-control" required="required" placeholder="0" name="sale_date" id="sale_date" >
            </div>
        </div><br>
        
        <div class="monthly_div " id="monthly_div">
            <h4 class="w-100">
                Billing Months
            </h4>
            
            <div class="monthly_div_row row">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="checkbox" name="month_checkbox" class="form-control">
                        <label for="month">Month</label>    
                    </div>
                    
                </div>
            </div>
            
        </div><br>
        
        <button type="submit" class="btn btn-primary btn-lg ml-3">Save</button>
    </div>
</form>
    </div>


    {{-- @include('layouts.footers.auth') --}}
@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/page_scripts/sales.js') }}"></script>
@endsection
@section('custom-script')
<script>
    $(document).ready(function() {
        $('#customers').select2();
    });
    document.getElementById('sale_date').value = new Date().toISOString().substring(0, 10);
</script>
@endsection
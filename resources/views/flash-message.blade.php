{{-- saad --}}
@if ($message = Session::get('success'))
<div class="ms-4 me-4 mt-4 alert alert-success" role="alert">
<strong>{{ $message }}</strong>
<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


@if ($message = Session::get('error'))
<div class="ms-4 me-4 mt-4 alert alert-danger" role="alert">
<strong>{{ $message }}</strong>
	<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>

</div>
@endif


@if ($message = Session::get('warning'))
<div class="ms-4 me-4 mt-4 alert alert-warning" role="alert">
<strong>{{ $message }}</strong>
	<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>

</div>
@endif


@if ($message = Session::get('info'))
<div class="ms-4 me-4 mt-4 alert alert-info" role="alert">
<strong>{{ $message }}</strong>
	<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>

</div>
@endif


@if ($errors->any())
<div class="ms-4 me-4 mt-4 alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>
	Please check the form below for errors
</div>
@endif

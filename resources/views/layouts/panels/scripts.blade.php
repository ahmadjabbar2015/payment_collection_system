{{-- @dd("HELLO"); --}}

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>

<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

@stack('js')


{{-- datatables --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> 

<!-- Argon JS -->
<script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
{{-- page script --}}
@yield('page-script')
{{-- page script --}}

{{-- custom scripts --}}
@yield('custom-script')

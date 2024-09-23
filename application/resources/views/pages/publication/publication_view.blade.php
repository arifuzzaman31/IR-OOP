@extends('layout.app')

@push('style')
<link rel="stylesheet" href="{{ asset('admin-assets/lib/css/min.css') }}">
<link rel="stylesheet" href="{{ asset('admin-assets/dflip/css/themify-icons.min.css') }}" type="text/css">
@endpush


@section('content')
<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title }}</h5>
        </div>
        <div class="widget-body">
            <div id="flipbookContainer">
            </div>
        </div>
    </div>
</div>


@endsection


@push('script')

<!-- Flipbook main Js file -->
<script src="{{ asset('admin-assets/lib/js/dflip.min.js') }} " type="text/javascript"></script>
<!-- Flipbook main Js file -->
<script>
    $(document).ready(function() {
        //uses source from online(make sure the file has CORS access enabled if used in cross-domain)
        // var pdf = 'http://localhost:8000/admin/publication/generate_pdf/4461712031255';
        // var pdf = ''https://mozilla.github.io/pdf.js/web/compressed.tracemonkey-pldi-09.pdf'';
        var pdf = "{{ url('admin/publication/generate_pdf/' .$publication->slug) }}";
        var options = {
            height: 1500,
            duration: 200,
            backgroundColor: "#dbdada"
        };
        var flipBook = $("#flipbookContainer").flipBook(pdf, options);
    });
</script>
@endpush
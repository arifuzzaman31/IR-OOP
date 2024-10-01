@extends('layout.app')

@push('style')
<!-- Flipbook StyleSheet -->
<link rel="stylesheet" href="{{ asset('admin-assets/dflip/css/dflip.min.css') }}" type="text/css">

<!-- Icons Stylesheet -->
<link rel="stylesheet" href="{{ asset('admin-assets/dflip/css/themify-icons.min.css') }}" type="text/css">
@endpush

@section('content')
<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title }}</h5>
        </div>
        <div class="widget-body row">
            <div class="col-12">
                <!--Normal FLipbook-->
                <!-- <div class="_df_book" height="750" webgl="true" backgroundcolor="#f3f0fc" source="{{ asset('admin-assets/dflip/pdf/drylab.pdf') }}" id="df_manual_book"></div> -->
                <div class="_df_book" height="750" webgl="true" backgroundcolor="#f3f0fc" source="{{ url('admin/publication/generate_pdf/' .$publication->slug) }}" id="df_manual_book"></div>
            </div>
        </div>
    </div>
</div>


@endsection


@push('script')
<!-- Flipbook main Js file -->
<script src="{{ asset('admin-assets/dflip/js/dflip.min.js') }}" type="text/javascript"></script>
@endpush
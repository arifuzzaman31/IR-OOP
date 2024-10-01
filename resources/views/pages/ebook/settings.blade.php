@extends('layout.app')
@section('content')
<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title }}</h5>
        </div>
        <div class="widget-body row">
            <div class="row col-md-8">
                <div class="col-md-12">
                    <label for="ebook_title">Site Title</label>
                    <input type="text" class="form-control" id="ebook_title" placeholder="" value="" required="">
                </div>
                <div class="col-md-12 mt-2 text-right">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="widget widget-table-two mt-4">
        <div class="widget-heading">
            <h5 class="">Change Password</h5>
        </div>
        <div class="widget-body row">
            <div class="row col-md-8">
                <div class="col-md-6">
                    <label for="ebook_title">New Password</label>
                    <input type="text" class="form-control" id="ebook_title" placeholder="" value="" required="">
                </div>
                <div class="col-md-6">
                    <label for="ebook_title">Confirm Password</label>
                    <input type="text" class="form-control" id="ebook_title" placeholder="" value="" required="">
                </div>
                <div class="col-md-12 mt-2 text-right">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
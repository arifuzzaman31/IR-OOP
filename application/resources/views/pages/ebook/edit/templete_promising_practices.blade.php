@extends('layout.app')

@section('content')
<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title }}</h5>
        </div>
        <div class="widget-body">
            <form id="cf-form" action="{{url('/admin/ebook_store/')}}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="ebook_title">Study Title</label>
                        <input type="text" class="form-control" id="ebook_title" name="ebook_title" placeholder="" value="" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="ebook_author_name">Name of Author</label>
                        <input type="text" class="form-control" id="ebook_author_name" name="ebook_author_name" placeholder="" value="" required="">
                    </div>
                    <div class="col-md-6">
                        <label for="ebook_date">Date</label>
                        <input type="date" class="form-control" id="ebook_date" name="ebook_date" placeholder="" value="" required="">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="introduction">Introduction/Background</label>
                        <textarea class="form-control" name="introduction" id="introduction" cols="30" rows="10"> </textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="key_achievement">Key Achievement</label>
                        <textarea class="form-control" name="key_achievement" id="key_achievement" cols="30" rows="10"> </textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="participants_benifited">How participants benefited?</label>
                        <textarea class="form-control" name="participants_benifited" id="participants_benifited" cols="30" rows="10"> </textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="strategy">Which stragety have used?</label>
                        <textarea class="form-control" name="strategy" id="strategy" cols="30" rows="10"> </textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="leason_learned">What lessons learned generated? </label>
                        <textarea class="form-control" name="leason_learned" id="leason_learned" cols="30" rows="10"> </textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="action_photo">Action Photo</label>
                        <textarea class="form-control" name="action_photo" id="action_photo" cols="30" rows="10"> </textarea>
                    </div>
                    <div class="col-md-12 text-right">
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="template_id" value="{{ $template_id }}">
                        <input type="hidden" name="templete_type" value="{{ $templete_type }}">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
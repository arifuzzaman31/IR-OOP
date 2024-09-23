@extends('layout.app')

@section('content')
<div class="section m-4 ebook_create_form">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title . ' - ' . $circular->title }} </h5>
        </div>
        <div class="widget-body">
            <form id="cf-form" action="{{url('/admin/ebook_store/')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 row">
                        <div class="col-md-12">
                            <label for="ebook_title">Study Title (15-20 Words)</label>
                            <input type="text" class="form-control dynamic_data" id="ebook_title" name="ebook_title" placeholder="" value="" required="" max_length="">
                        </div>
                        <div class="col-md-12">
                            <label for="ebook_author_name">Name of Author</label>
                            <input type="text" class="form-control dynamic_data" id="ebook_author_name" name="ebook_author_name" placeholder="" value="" required="">
                        </div>
                        <div class="col-md-12">
                            <label for="ebook_date">Date</label>
                            <input type="date" class="form-control dynamic_data" id="ebook_date" name="ebook_date" placeholder="" value="" required="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        @include('partials.upload_files', ['label' => "Cover Picture" , 'name' =>"cover_image_id", 'value'=> ($method == "edit") ? $ebook?->cover_image_id : "", 'multiple' => false, 'preview_url' => ($method == "edit") ? $ebook?->cover_image_mave?->file_path : "" ])
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="ebook_abstract">Abstract (200 Word)</label>
                        <textarea class="form-control dynamic_data" name="ebook_abstract" id="ebook_abstract" cols="30" rows="10" max_length="200"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="ebook_intro">Introduction and Objective (200 Word)</label>
                        <textarea class="form-control dynamic_data" name="ebook_intro" id="ebook_intro" cols="30" rows="10" max_length="200"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="ebook_literature_review">Literature Review (500 Word)</label>
                        <textarea class="form-control dynamic_data" name="ebook_literature_review" id="ebook_literature_review" cols="30" rows="10" max_length="200"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="ebook_method">Methodology (300 Word)</label>
                        <textarea class="form-control dynamic_data" name="ebook_method" id="ebook_method" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="ebook_rd">Results & Discussions (2000 Word)</label>
                        <textarea class="form-control dynamic_data" name="ebook_rd" id="ebook_rd" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="ebook_cr">Conclusion and Recommendations (300 Word)</label>
                        <textarea class="form-control dynamic_data" name="ebook_cr" id="ebook_cr" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="ebook_reference">Reference (500 Word)</label>
                        <textarea class="form-control dynamic_data" name="ebook_reference" id="ebook_reference" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 text-right">
                        @if ($method == "edit")
                        <input type="hidden" name="slug" value="{{ $ebook->slug }}">
                        @endif
                        <input type="hidden" name="method" value="{{ $method }}">
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="template_id" value="{{ $template_id }}">
                        <input type="hidden" name="templete_type" value="{{ $templete_type }}">
                        <input type="hidden" name="circular_id" value="{{ $circular['id'] }}">
                        <input type="hidden" name="submission_type" id="submission_type" value="none">

                        <input type="submit" class="btn btn-primary" onclick="return ( $('#submission_type').val('save'))" value="Save">
                        <input type="submit" class="btn btn-success" onclick="return ($('#submission_type').val('submit'))" value="Submit">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('partial_inner.partial_ebook_create', [$templete])

@if ($method == "edit")
@include('partial_inner.partial_ebook_edit', [$ebook,$ebook_form_data])
@endif
@endsection
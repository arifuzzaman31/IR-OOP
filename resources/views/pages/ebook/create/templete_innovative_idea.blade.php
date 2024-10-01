@extends('layout.app')

@section('content')
<div class="section m-4 ebook_create_form">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title . ' - ' . $circular->title }} </h5>
        </div>

        <form id="cf-form" action="{{url('/admin/ebook_store/')}}">
            @csrf
            <div class="widget-body">
                <div class="row">
                    <div class="col-md-6 row">
                        <div class="col-md-12">
                            <label for="ebook_title">Name of Idea (10-15 Words)</label>
                            <input type="text" class="form-control dynamic_data" id="ebook_title" name="ebook_title" placeholder="" value="" required="">
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
                        @include('partials.upload_files', ['label' => "Cover Picture" , 'name' =>"cover_image_id", 'value'=> ($method == "edit") ? $ebook->cover_image_id : "", 'multiple' => false, 'preview_url' => ($method == "edit") ? ($ebook->cover_image_mave && $ebook->cover_image_mave->file_path) : "" ])
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="problem">What is the problem? (200 Word)</label>
                        <textarea class="form-control dynamic_data" name="problem" id="problem" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="why_innovative">Why is it innovative? (200 Word)</label>
                        <textarea class="form-control dynamic_data" name="why_innovative" id="why_innovative" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="participants">Who are the participants? (100 Word)</label>
                        <textarea class="form-control dynamic_data" name="participants" id="participants" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="how_work">How it will work? (200 Word)</label>
                        <textarea class="form-control dynamic_data" name="how_work" id="how_work" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="look_like">What will it look like? (200 Word)</label>
                        <textarea class="form-control dynamic_data" name="look_like" id="look_like" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="benifits_participants">What is the benefit for the participants? (100 Word)</label>
                        <textarea class="form-control dynamic_data" name="benifits_participants" id="benifits_participants" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="benefit_organization">What is the benefit for the organization? (100 Word)</label>
                        <textarea class="form-control dynamic_data" name="benefit_organization" id="benefit_organization" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="scale_up">How can be sustainable of your idea or scale up? (100 Word)</label>
                        <textarea class="form-control dynamic_data" name="scale_up" id="scale_up" cols="30" rows="10"></textarea>
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
            </div>
        </form>
    </div>
</div>

@include('partial_inner.partial_ebook_create', [$templete])

@if ($method == "edit")
@include('partial_inner.partial_ebook_edit', [$ebook,$ebook_form_data])
@endif
@endsection

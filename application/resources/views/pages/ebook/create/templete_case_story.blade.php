@extends('layout.app')

@section('content')
<div class="section m-4 ebook_create_form">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title . ' - ' . $circular->title }} </h5>
        </div>
        <form id="cf-form" action="{{url('/admin/ebook_store/')}}">
            @csrf
            <div class=" widget-body">
                <div class="row">
                    <div class="col-md-6 row">
                        <div class="col-md-12">
                            <label for="ebook_title">Study Title (8-10 Word)</label>
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
                        @include('partials.upload_files', ['label' => "Cover Picture" , 'name' =>"cover_image_id", 'value'=> ($method == "edit") ? $ebook?->cover_image_id : "", 'multiple' => false, 'preview_url' => ($method == "edit") ? $ebook?->cover_image_mave?->file_path : "" ])
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="introduction">Introduction/Background (150 Word)</label>
                        <textarea class="form-control dynamic_data" name="introduction" id="introduction" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="problem_solution">Problem & Solution (300 Word)</label>
                        <textarea class="form-control dynamic_data" name="problem_solution" id="problem_solution" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="organization_contribution">Organization contribution (100 Word)</label>
                        <textarea class="form-control dynamic_data" name="organization_contribution" id="organization_contribution" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="community_contribution">Community Contribution (100 Word)</label>
                        <textarea class="form-control dynamic_data" name="community_contribution" id="community_contribution" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="sustain_success">Sustainability of success (250 Word)</label>
                        <textarea class="form-control dynamic_data" name="sustain_success" id="sustain_success" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="participants_quotes">Participants Quotes (100 Word)</label>
                        <textarea class="form-control dynamic_data" name="participants_quotes" id="participants_quotes" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="action_photo">Action Photo (With Caption)</label>
                        <textarea class="form-control dynamic_data" name="action_photo" id="action_photo" cols="30" rows="10"></textarea>
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
        <div id="cf-response-message"></div>
    </div>
</div>

@include('partial_inner.partial_ebook_create', [$templete])

@if ($method == "edit")
@include('partial_inner.partial_ebook_edit', [$ebook,$ebook_form_data])
@endif
@endsection
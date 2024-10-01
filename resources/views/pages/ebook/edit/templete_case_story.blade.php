@extends('layout.app')

@section('content')
<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title }}</h5>
        </div>
        <form id="cf-form" action="{{url($post_url)}}">
            @csrf
            <div class=" widget-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="ebook_title">Study Title</label>
                        <input type="text" class="form-control" id="ebook_title" name="ebook_title" placeholder="" value="{{ $ebook->title }}" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="ebook_author_name">Name of Author</label>
                        <input type="text" class="form-control" id="ebook_author_name" name="ebook_author_name" placeholder="" value="{{ $ebook->author_name }}" required="">
                    </div>
                    <div class="col-md-6">
                        <label for="ebook_date">Date</label>
                        <input type="date" class="form-control" id="ebook_date" name="ebook_date" placeholder="" value="{{ $ebook->date }}" required="">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="introduction">Introduction/Background</label>
                        <textarea class="form-control" name="introduction" id="introduction" cols="30" rows="10">{{ $ebook->form_data }}</textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="problem_solution">Problem & Solution</label>
                        <textarea class="form-control" name="problem_solution" id="problem_solution" cols="30" rows="10">{{ $ebook_form_data->problem_solution }}</textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="organization_contribution">Organization contribution</label>
                        <textarea class="form-control" name="organization_contribution" id="organization_contribution" cols="30" rows="10">{{ $ebook_form_data->organization_contribution }}</textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="community_contribution">Community Contribution</label>
                        <textarea class="form-control" name="community_contribution" id="community_contribution" cols="30" rows="10">{{ $ebook_form_data->community_contribution }}</textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="sustain_success">Sustainability of success </label>
                        <textarea class="form-control" name="sustain_success" id="sustain_success" cols="30" rows="10">{{ $ebook_form_data->sustain_success }}</textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="participants_quotes">Participants Quotes </label>
                        <textarea class="form-control" name="participants_quotes" id="participants_quotes" cols="30" rows="10">{{ $ebook_form_data->participants_quotes }}</textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="action_photo">Action Photo</label>
                        <textarea class="form-control" name="action_photo" id="action_photo" cols="30" rows="10">{{ $ebook_form_data->action_photo }}</textarea>
                    </div>
                    <div class="col-md-12 text-right">
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="template_id" value="{{ $template_id }}">
                        <input type="hidden" name="templete_type" value="{{ $templete_type }}">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
        <div id="cf-response-message"></div>

    </div>


</div>
@endsection

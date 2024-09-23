@extends('layout.app')

@section('content')
<div class="section m-4 evaluation_form">
    <div class="widget widget-table-two ">
        <div class="widget-heading">
            <h5 class="">{{ $page_title }}</h5>
        </div>
        <div class=" widget-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Cover Image</label>
                        <div class="bg-ash rounded text-center p-2">
                            <a href="{{ asset('/') .(($ebook->cover_image_mave) ? $ebook->cover_image_mave->file_path :'media/default_broken.jpg') }}" target="_blank">
                                <img class="img-fluid rounded p-4" src="{{ asset('/') .(($ebook->cover_image_mave) ? $ebook->cover_image_mave->file_path :'media/default_broken.jpg') }}" width="50%" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 row">
                    <div class="col-md-12">
                        <label for="ebook_title">Study Title</label>
                        <textarea class="form-control" name="ebook_title" id="ebook_title" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="ebook_author_name">Name of Author</label>
                        <input type="text" class="form-control" id="ebook_author_name" name="ebook_author_name" placeholder="" value="">
                    </div>
                    <div class="col-md-12">
                        <label for="ebook_date">Date</label>
                        <input type="date" class="form-control" id="ebook_date" name="ebook_date" placeholder="" value="" required="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label for="introduction">Introduction/Background</label>
                    <textarea class="form-control" name="introduction" id="introduction" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="problem_solution">Problem & Solution</label>
                    <textarea class="form-control" name="problem_solution" id="problem_solution" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="organization_contribution">Organization contribution</label>
                    <textarea class="form-control" name="organization_contribution" id="organization_contribution" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="community_contribution">Community Contribution</label>
                    <textarea class="form-control" name="community_contribution" id="community_contribution" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="sustain_success">Sustainability of success </label>
                    <textarea class="form-control" name="sustain_success" id="sustain_success" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="participants_quotes">Participants Quotes </label>
                    <textarea class="form-control" name="participants_quotes" id="participants_quotes" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="action_photo">Action Photo</label>
                    <textarea class="form-control" name="action_photo" id="action_photo" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="evaluation">Overall Feedback</label>
                    <input type="hidden" class="form-control" name="evaluation" id="evaluation" />
                </div>

                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" id="submit_evaluation">Submit</button>
                </div>
            </div>
        </div>
        <div id="cf-response-message"></div>
    </div>
</div>


@include('partial_inner.partial_ebook_feedback', $ebook)
@endsection
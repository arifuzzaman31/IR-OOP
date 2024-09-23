@extends('layout.app')

@section('content')
<div class="section m-4 evaluation_form">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title }}</h5>
        </div>

        <div class="widget-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Cover Image </label>
                        <div class="bg-ash rounded text-center p-2">
                            <a href="{{ asset('/') .(($ebook->cover_image_mave) ? $ebook->cover_image_mave->file_path :'media/default_broken.jpg') }}" target="_blank">
                                <img class="img-fluid rounded p-4" src="{{ asset('/') .(($ebook->cover_image_mave) ? $ebook->cover_image_mave->file_path :'media/default_broken.jpg') }}" width="50%" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 row">
                    <div class="col-md-12">
                        <label for="ebook_title">Name of Idea (10-15 Words)</label>
                        <textarea class="form-control" name="ebook_title" id="ebook_title" cols="30" rows="3"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="ebook_author_name">Name of Author</label>
                        <input type="text" class="form-control" id="ebook_author_name" name="ebook_author_name" placeholder="" value="" required="">
                    </div>
                    <div class="col-md-12">
                        <label for="ebook_date">Date</label>
                        <input type="date" class="form-control" id="ebook_date" name="ebook_date" placeholder="" value="" required="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label for="problem">What is the problem? (200 Word)</label>
                    <textarea class="form-control" name="problem" id="problem" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="why_innovative">Why is it innovative? (200 Word)</label>
                    <textarea class="form-control" name="why_innovative" id="why_innovative" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="participants">Who are the participants? (100 Word)</label>
                    <textarea class="form-control" name="participants" id="participants" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="how_work">How it will work? (200 Word)</label>
                    <textarea class="form-control" name="how_work" id="how_work" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="look_like">What will it look like? (200 Word)</label>
                    <textarea class="form-control" name="look_like" id="look_like" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="benifits_participants">What is the benefit for the participants? (100 Word)</label>
                    <textarea class="form-control" name="benifits_participants" id="benifits_participants" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="benefit_organization">What is the benefit for the organization? (100 Word)</label>
                    <textarea class="form-control" name="benefit_organization" id="benefit_organization" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="scale_up">How can be sustainable of your idea or scale up? (100 Word)</label>
                    <textarea class="form-control" name="scale_up" id="scale_up" cols="30" rows="10"></textarea>
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
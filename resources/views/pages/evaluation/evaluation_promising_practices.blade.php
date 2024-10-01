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
                        <label for="ebook_title">Study Title (10-12 Word)</label>
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
                    <label for="introduction">Introduction/Background (150 Word)</label>
                    <textarea class="form-control" name="introduction" id="introduction" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="key_achievement">Key Achievement (250 Word)</label>
                    <textarea class="form-control" name="key_achievement" id="key_achievement" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="participants_benifited">How participants benefited? (200 Word)</label>
                    <textarea class="form-control" name="participants_benifited" id="participants_benifited" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="strategy">Which stragety have used? (200 Word)</label>
                    <textarea class="form-control" name="strategy" id="strategy" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="leason_learned">What lessons learned generated? (200 Word)</label>
                    <textarea class="form-control" name="leason_learned" id="leason_learned" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="action_photo">Action Photo (With Caption)</label>
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
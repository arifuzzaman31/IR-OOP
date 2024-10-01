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
                        <label for="ebook_title">Study Title (15-20 Words)</label>
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
                    <label for="ebook_abstract">Abstract (200 Word)</label>
                    <textarea class="form-control" name="ebook_abstract" id="ebook_abstract" cols="30" rows="10" max_length="5"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="ebook_intro">Introduction and Objective (200 Word)</label>
                    <textarea class="form-control" name="ebook_intro" id="ebook_intro" cols="30" rows="10" max_length="30"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="ebook_literature_review">Literature Review (500 Word)</label>
                    <textarea class="form-control" name="ebook_literature_review" id="ebook_literature_review" cols="30" rows="10" max_length="40"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="ebook_method">Methodology (300 Word)</label>
                    <textarea class="form-control" name="ebook_method" id="ebook_method" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="ebook_rd">Results & Discussions (2000 Word)</label>
                    <textarea class="form-control" name="ebook_rd" id="ebook_rd" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="ebook_cr">Conclusion and Recommendations (300 Word)</label>
                    <textarea class="form-control" name="ebook_cr" id="ebook_cr" cols="30" rows="10"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="ebook_reference">Reference (500 Word)</label>
                    <textarea class="form-control" name="ebook_reference" id="ebook_reference" cols="30" rows="10"></textarea>
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
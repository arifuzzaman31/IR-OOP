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
                        <label for="ebook_abstract">Abstract</label>
                        <textarea class="form-control" name="ebook_abstract" id="ebook_abstract" cols="30" rows="10"> </textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="ebook_intro">Introduction and Objective</label>
                        <textarea class="form-control" name="ebook_intro" id="ebook_intro" cols="30" rows="10"> </textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="ebook_literature_review">Literature Review</label>
                        <textarea class="form-control" name="ebook_literature_review" id="ebook_literature_review" cols="30" rows="10"> </textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="ebook_method">Methodology</label>
                        <textarea class="form-control" name="ebook_method" id="ebook_method" cols="30" rows="10"> </textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="ebook_rd">Results & Discussions </label>
                        <textarea class="form-control" name="ebook_rd" id="ebook_rd" cols="30" rows="10"> </textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="ebook_cr">Conclusion and Recommendations </label>
                        <textarea class="form-control" name="ebook_cr" id="ebook_cr" cols="30" rows="10"> </textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="ebook_reference">Reference</label>
                        <textarea class="form-control" name="ebook_reference" id="ebook_reference" cols="30" rows="10"> </textarea>
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
@extends('layout.app')

@section('content')
    <div class="section m-4 ebook_create_form">
        <div class="widget widget-table-two">
            <div class="widget-heading">
                <h5 class="">{{ $page_title }}</h5>
            </div>
            <form id="cf-form" action="{{ url('/admin/circular_store/') }}">
                @csrf
                <div class="widget-body">
                    <div class="row">
                        <div class="col-md-6">
                            @include('partials.upload_files', ['label' => "Cover Picture" , 'name' =>"cover_image_id", 'value'=> ($method == "edit") ? $circular?->cover_image_id : "", 'multiple' => false, 'preview_url' => ($method == "edit") ? $circular?->cover_image_mave?->file_path : "" ])
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Please write " value="" required="">
                        </div>
                        <div class="col-md-6">
                            <label for="ebook_author_name">Category</label>
                            <select name="template_id" id="template_id" class="form-control">
                                @foreach ($template_list as $item)
                                    <option value={{ $item->id }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="deadline">Deadline</label>
                            <input type="date" class="form-control" id="deadline" name="deadline" placeholder=""
                                value="" required="">
                        </div>
                        <div class="col-md-6">
                            <label for="deadline">Jury</label>
                            <select id="jury" class="form-control select_2" name="jury_members[]" multiple="multiple">
                                @foreach ($jury_list as $item)
                                    <option value={{ $item->id }}>{{ $item->firstname . ' ' . $item->lastname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            <div id="cf-response-message"></div>
        </div>
    </div>
@endsection

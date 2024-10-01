@extends('layout.app')

@section('content')
    <div class="section m-4 ebook_create_form">
        <div class="widget widget-table-two">
            <div class="widget-heading">
                <h5 class="">{{ $page_title }}</h5>
            </div>
            <form id="cf-form" action="{{ url('/admin/circular_update/' . $circular['id']) }}">
                @csrf
                <div class="widget-body">
                    <div class="row">
                        <div class="col-md-6">
                            @include('partials.upload_files', ['label' => "Cover Picture" , 'name' =>"cover_image_id", 'value'=> ($method == "edit") ? $circular->cover_image_id : "", 'multiple' => false, 'preview_url' => ($method == "edit") ? ($circular->cover_image_mave && $circular->cover_image_mave->file_path) : "" ])
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Please write " value="{{ $circular->title }}" required="">
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
                                value="{{ $circular->deadline }}" required="">
                        </div>
                        <div class="col-md-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0">Disable</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <div id="cf-response-message"></div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            let template_id = "{{ $circular->template_id }}";
            let status = "{{ $circular->status }}";
            $('#template_id').val(template_id).change();
            $('#status').val(status).change();
        });
    </script>
@endpush

@extends('layout.app')

@php
$found_ebook = false;
$found_publication = false;
@endphp
@section('content')
<div class="section m-4 row">
    <!-- <div class="col-md-12 mb-5">
        <h5 class="text-center">Welcome to dashboard</h5>
    </div> -->
    <div class="col-md-4 col-sm-6 col-12 layout-spacing">
        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <div class="widget widget-card-four mb-2">
            <div class="widget-content">
                <div class="w-content">
                    <div class="w-icon d-flex justify-content-between">
                        <div>
                            <h3 class="value">{{ $user_count }}</h3>
                            <h3>Authors</h3>
                        </div>
                        <div class="text-right">
                            <h3 class="value"> {{ $jury_count }}</h3>
                            <h3>Juries</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="widget widget-table-two">
            <div class="widget-heading">
            </div>
            <div class="widget-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-left">
                                <div class="th-content">#</div>
                            </th>
                            <th>
                                <div class="th-content">Category</div>
                            </th>
                            <th>
                                <div class="th-content text-center">Ebook</div>
                            </th>
                            <th>
                                <div class="th-content text-center">Published</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($count=1)
                        @foreach($templates as $item)
                        <tr>
                            <td class="text-left">{{ $count++ }}</td>
                            <td class="pl-2">{{ $item['title'] }}</td>
                            <td class="text-center">

                                @foreach($ebook_count as $ebook_item)
                                @if($ebook_item['template_id'] == $item['id'])
                                {{ $ebook_item['ebooks'] }}
                                @endif
                                @endforeach
                            </td>
                            <td class="text-center">
                                @foreach($publication_count as $publication_item)
                                @if($publication_item['template_id'] == $item['id'])
                                {{ $publication_item['publications'] }}
                                @endif
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="col-md-8 col-sm-6 col-12 layout-spacing">

        <div class="widget widget-table-two">
            <div class="widget-heading">
                <h5>Latest Publications</h5>
            </div>
            <div class="widget-body">
                <table class="table table-striped">
                    <table class="table table-striped datatable datatable_custom">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    <div class="th-content">ID</div>
                                </th>
                                <th>
                                    <div class="th-content">Date</div>
                                </th>
                                <th>
                                    <div class="th-content">Author</div>
                                </th>
                                <th>
                                    <div class="th-content">Category</div>
                                </th>
                                <th>
                                    <div class="th-content text-left">Title</div>
                                </th>
                                <th>
                                    <div class="th-content text-left">Status</div>
                                </th>
                                <th>
                                    <div class="th-content">Action</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($count_pub=1)
                            @foreach($latest_publications as $item)
                            <tr>
                                <td class="text-left">{{ $count_pub++ }}</td>
                                <td>{{ date("d-m-Y", strtotime($item['created_at'])) }}</td>
                                <td>{{ $item['author_name'] }}</td>
                                <td>{{ $item['templates_mave']->title }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ $item['approval_status'] }}</td>
                                <td>
                                    <a href="{{ url('admin/publication/view'). '/' .$item['slug'] }}" class="btn btn-primary" role="button" title="View">
                                        <i class="fa fa-desktop" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ url('admin/publication/generate_pdf'). '/' .$item['slug'] }}" class="btn btn-success mr-2" role="button" title="PDF View" target="_blank">
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

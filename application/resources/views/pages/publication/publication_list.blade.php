@extends('layout.app')

@section('content')
<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title }}</h5>
        </div>
        <div class="widget-body">
            <div class="table-responsive">
                <table class="table table-striped datatable datatable_custom">
                    <thead>
                        <tr>
                            <th class="text-left">
                                <div class="th-content">ID</div>
                            </th>
                            <th>
                                <div class="th-content">Category</div>
                            </th>
                            <th>
                                <div class="th-content">Circular</div>
                            </th>
                            <th>
                                <div class="th-content">Date</div>
                            </th>
                            <th>
                                <div class="th-content">Author</div>
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
                        @php($count=1)
                        @foreach($publications as $item)
                        <tr>
                            <td class="text-left">{{ $count++ }}</td>
                            <td>{{ $item['templates_mave']?->title }}</td>
                            <td>{{ $item['circular_mave']?->title }}</td>
                            <td>{{ date("d-m-Y", strtotime($item['created_at']));  }}</td>
                            <td>{{ $item['author_name'] }}</td>
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
            </div>
        </div>
    </div>
</div>
@endsection
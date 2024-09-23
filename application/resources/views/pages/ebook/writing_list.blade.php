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
                            <th>
                                <div class="th-content text-left">ID</div>
                            </th>
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
                            <th>
                                <div class="th-content text-left">Title</div>
                            </th>
                            <th>
                                <div class="th-content text-left">Created By</div>
                            </th>
                            <th>
                                <div class="th-content text-left">Date of Creation</div>
                            </th>
                            <th>
                                <div class="th-content">Action</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($count=1)
                        @foreach($ebooks as $item)
                        <tr>
                            <td class="text-left">{{ $count++ }}</td>
                            <td>{{ $item['templates_mave']?->title }}</td>
                            <td>{{ $item['circular_mave']?->title }}</td>
                            <td>{{ date("d M Y", strtotime($item['date']));  }}</td>
                            <td>{{ $item['author_name'] }}</td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['author_mave'] ? $item['author_mave']->firstname . " " . $item['author_mave']->lastname : "" }}</td>
                            <td>{{ date("d M Y", strtotime($item['created_at']));  }}</td>
                            <td class="action_btn">
                                <!--<a href="{{ url('admin/ebook/edit/'. $item['templates_mave']?->slug .'/'. $item['slug']) }}" class="btn btn-warning" role="button" title="Edit">-->
                                <!--    <i class="fa fa-pencil" aria-hidden="true"></i>-->
                                <!--</a>-->
                                <a href="{{ url('admin/circular_ebook/edit/'. $item['templates_mave']?->slug .'/'. $item['circular_mave']?->slug .'/'. $item['slug']) }}" class="btn btn-warning" role="button" title="Edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a href="{{ url('admin/ebook_delete/'). '/' .$item['slug'] }}" onclick="return confirm('Delete item?')" class="btn btn-danger" role="button" title="View">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
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



<!-- Writing, Pending, InReview, Reviewed, Published, Draft, Revision -->
<!-- Writing, Pending, InReview, Published, Canceled -->
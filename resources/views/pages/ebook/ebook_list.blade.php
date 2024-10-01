@extends('layout.app')

@section('content')
<style>
    .ebook_list_table .table-responsive {
        min-height: 75vh;
    }
</style>
<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title }}</h5>
        </div>
        <div class="widget-body ebook_list_table">
            <div class="table-responsive">
                <table class="table table-striped datatable datatable_custom" >
                    <thead>
                        <tr>
                            <th>
                                <div class="th-content text-left">ID</div>
                            </th>

                            <th>
                                <div class="th-content">Category</div>
                            </th>
                            <th>
                                <div class="th-content text-left">Circular</div>
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
                                <div class="th-content text-left">Evaluate</div>
                            </th>
                            <th>
                                <div class="th-content text-left">Created By</div>
                            </th>
                            <th>
                                <div class="th-content text-left">Date of Creation</div>
                            </th>
                             <th>
                                <div class="th-content text-left">Action</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($count=1)
                        @foreach($ebooks as $item)
                        @php($allow_role_ids = [1,2,4])
                        @if( in_array(strval(Auth::user()->role_id), $allow_role_ids) || (Auth::user()->role_id == 3 && in_array(strval(Auth::user()->id), $item->circular_mave["jury_members"])))
                        <tr>
                            <td class="text-left">{{ $count++ }}</td>


                            <td>{{ $item['templates_mave']->title }}</td>
                            <td>{{ $item['circular_mave']['title'] }}</td>
                            <td>{{ date("d M Y", strtotime($item['date']))  }}</td>
                            <td>{{ $item['author_name'] }}</td>
                            <td>{{ $item['title'] }}</td>
                            <!--<td class="jury_memeber_list" data-ebook_id="{{ $item->id }}">-->
                            <!--    @if(!empty($item->jury_members_mave))-->
                            <!--    @foreach ($item->jury_members_mave as $jury_mave)-->

                            <!--    <div class="jury_member_single">-->
                            <!--        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 )-->
                            <!--        <a href="#" class="text-danger remove_jury_member" data-action_type="remove" data-ebook_id="{{ $item->id }}" data-jury_id="{{ $jury_mave->id }}" title="Remove Jury">-->
                            <!--            <i class="fa fa-trash"></i>-->
                            <!--        </a>-->
                            <!--        @endif-->
                            <!--        <span>-->
                            <!--            {{ $jury_mave->firstname.' ' .$jury_mave->lastname}}-->
                            <!--        </span>-->
                            <!--        <br>-->
                            <!--    </div>-->
                            <!--    @endforeach-->
                            <!--    @endif-->
                            <!--</td>-->
                            <td> {{ $item['approval_status'] }}</td>
                            <td>
                                @if($item['approval_status'] == "InReview" &&
                                (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 ||(Auth::user()->role_id == 3 && (App\Helpers\CustomHelper::jury_circular_evaluation_auth($item['circular_id'],Auth::user()->id) > 0 ))))
                                @if(App\Helpers\CustomHelper::jury_evaluated_check($item['id'],Auth::user()->id) == true)
                                <a href="{{ url('admin/evaluate/'). '/' .$item['slug'] }}" class="badge badge-pill badge-warning" title="Evaluate Now">
                                    Pending
                                </a>
                                @else
                                <a href="{{ url('admin/evaluations/'). '/' .$item['slug'] }}" class="badge badge-pill badge-success" title="Evaluate Now">
                                    Submitted
                                </a>
                                @endif
                                @endif
                            </td>
                            <td>{{ $item['author_mave'] ? $item['author_mave']->firstname . " " . $item['author_mave']->lastname : "" }}</td>
                            <td>{{ date("d M Y", strtotime($item['created_at']))  }}</td>



                            <!---------------------------------------------------------------------------------------new----------------------------------------------------------------------------------------------------------------------->



                          <td class="text-left"  >

                                   <div
                                                class="dropdown custom-dropdown "
                                            >
                              <a
                                                    class="dropdown-toggle"
                                                    href="#"
                                                    role="button"
                                                    id="dropdownMenuLink2"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"


                                                >
                                                    <svg

                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-more-horizontal"

                                                    >
                                                        <circle
                                                            cx="12"
                                                            cy="12"
                                                            r="1"
                                                        ></circle>
                                                        <circle
                                                            cx="19"
                                                            cy="12"
                                                            r="1"
                                                        ></circle>
                                                        <circle
                                                            cx="5"
                                                            cy="12"
                                                            r="1"
                                                        ></circle>
                                                    </svg>
                                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                    <!-- <a href="{{ url('admin/ebook_view/'). '/' .$item['slug'] }}" class="dropdown-item" role="button" title="View">
                                    <i class="fa fa-desktop" aria-hidden="true"></i>
                                </a> -->
                                    <a href="{{ url('admin/publication/generate_pdf'). '/' .$item['slug'] }}" class="dropdown-item" role="button" title="PDF View" target="_blank">
                                        <!-- <i class="fa fa-file-pdf-o" aria-hidden="true"></i> -->
                                        View PDF
                                    </a>

                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || (Auth::user()->id == $item['author_id'] && $item['status'] == "writing") )
                                    <a href="{{ url('admin/circular_ebook/edit/'. $item['templates_mave']->slug .'/'. $item['circular_mave']->slug .'/'. $item['slug']) }}" class="dropdown-item" role="button" title="Edit">
                                        <!-- <i class="fa fa-pencil" aria-hidden="true"></i> -->
                                        Edit
                                    </a>
                                    <a href="#" data-slug="{{ $item['slug'] }}" data-status="{{ $item['approval_status'] }}" class="ebook_status dropdown-item" data-toggle="modal" data-target="#status" title="Change Status">
                                        <!-- <i class="fa fa-check-circle" aria-hidden="true"></i> -->
                                        Status
                                    </a>
                                    @endif



                                    <!--@if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 )-->
                                    <!--<a href="#" class="dropdown-item add_jury_member" role="button" title="Add Jury" data-toggle="modal" data-target="#juryMemberAdd" data-templete-title="{{ $item->title }}" data-ebook-id="{{ $item->id }}">-->
                                    <!--    <i class="fa fa-user-plus" aria-hidden="true"></i>-->
                                    <!--</a>-->
                                    <!--@endif-->

                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <a href="{{ url('admin/ebook_delete/'). '/' .$item['slug'] }}" onclick="return confirm('Delete item?')" class="dropdown-item" role="button" title="Delete">
                                        <!-- <i class="fa fa-trash" aria-hidden="true"></i> -->
                                        Delete
                                    </a>
                                    @endif

                                    <div class="dropdown-divider"></div>
                                    @if($item['approval_status'] == "InReview" &&
                                    (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 ||(Auth::user()->role_id == 3 && (App\Helpers\CustomHelper::jury_circular_evaluation_auth($item['circular_id'],Auth::user()->id) > 0 ))))
                                    @if(App\Helpers\CustomHelper::jury_evaluated_check($item['id'],Auth::user()->id) == true)
                                    <a href="{{ url('admin/evaluate/'). '/' .$item['slug'] }}" class="dropdown-item" title="Evaluate Now">
                                        <!-- <i class="fa fa-commenting-o" aria-hidden="true"></i> -->
                                        <span class="badge badge-warning">Evaluate Now</span>
                                    </a>
                                    @else <span class="badge badge-success">Evaluated</span>
                                    @endif
                                    @else <span class="badge badge-danger">Unauthorized</span>
                                    @endif

                                    <a href="{{ url('admin/evaluations/'). '/' .$item['slug'] }}" class="dropdown-item" title="Evaluations">
                                        <!-- <i class="fa fa-comments" aria-hidden="true"></i> -->
                                        View Evaluations
                                    </a>

                                    <!--
                                {{ "Circular:". $item['circular_id'] }}
                                {{ "Ebook:". $item['id'] }}
                                {{ "User:". Auth::user()->id }} -->

                                </div>
                                </div>
                            </td>


                             <!---------------------------------------------------------------------------------------new----------------------------------------------------------------------------------------------------------------------->


                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Status Modal -->
<div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="statusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ url('admin/ebook_status_update/') }}" id="cf-form" method="POST">
                <!-- @csrf -->
                <div class="modal-header">
                    <h5 class="modal-title" id="statusLabel">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="change_status">Status</label>
                    <select class="form-control" name="approval_status" id="change_status">
                        <option value="Pending">Pending</option>
                        <option value="InReview">InReview</option>
                        <option value="Published">Publish</option>
                        <option value="Canceled">Cancel</option>
                    </select>
                    <div id="cf-response-message"></div>
                </div>
                <div class="modal-footer">
                    <!-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>


<!-- Jury - Add or Remove  -->


<!-- Modal -->
<div class="modal fade" id="juryMemberAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="juryMemberAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="juryMemberAddLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Add Member</label>
                            <select class="form-control" name="member_id" id="member_id">
                                <option value="">Select Any</option>
                                @foreach ($jury_list as $jury)
                                <option value="{{ $jury->id }}">{{ $jury->firstname .' ' . $jury->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="" value="0" id="ebook_id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add_new_jury" data-action_type="add">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')

<!-- Change Ebook Status -->
<script>
    $(function() {
        $(document).on('click', '.ebook_status', function(e) {
            e.preventDefault();
            let slug = $(this).attr('data-slug');
            let current_status = $(this).attr('data-status');
            let form_url = $('#cf-form').attr('action');
            $('#cf-form').attr('action', APP_URL + 'admin/ebook_status_update/' + slug);
            $('#change_status').val(current_status).change();
        });
    });
</script>


<!-- Add or Remove Jury Member -->
<script>
    $(document).on('click', '.add_jury_member', function(e) {
        e.preventDefault();
        $('#juryMemberAddLabel').text('Templete: ' + $(this).attr('data-templete-title'));
        $('#ebook_id').val($(this).attr('data-ebook-id'));
    });

    $(document).on('click', '#add_new_jury, .remove_jury_member', async function(e) {
        e.preventDefault();
        let data = {};
        let action_type = $(this).attr('data-action_type');
        let URL = "{{ url('admin/ebook_update_jury/')}}" + '/' + action_type;


        if (action_type == "remove") {
            data = {
                ebook_id: $(this).attr('data-ebook_id'),
                member_id: $(this).attr('data-jury_id')
            }
            $(this).closest(".jury_member_single").remove()
        }

        if (action_type == "add") {
            data = {
                ebook_id: $('#ebook_id').val(),
                member_id: $('#member_id').val()
            }
            $('#juryMemberAdd').modal('toggle');


            let elem = `<div class="jury_member_single">
                            <a href="#" class="text-danger remove_jury_member" data-action_type="remove" data-ebook_id="${$('#ebook_id').val()}" data-jury_id="${$('#member_id').val()}" title="Remove Jury">
                                <i class="fa fa-trash"></i>
                            </a>
                            <span>${$('#member_id').find('option:selected').text()}</span>
                            <br>
                        </div>`;


            $(`.jury_memeber_list[data-ebook_id="${$('#ebook_id').val()}"]`).append(elem);
        }


        let response = await custom_ajax('POST', URL, data);
        if (response.status == 200) {
            Snackbar.show({
                text: 'Jury Updated Successfully.',
                pos: 'bottom-right',
                backgroundColor: "#35a598"
            });
        } else {
            Snackbar.show({
                text: 'Something went wrong! Please try again later',
                pos: 'bottom-right',
                backgroundColor: "#f20000"
            });
        }

    });
</script>

@endpush

<!-- Writing, Pending, InReview, Reviewed, Published, Draft, Revision -->
<!-- Writing, Pending, InReview, Published, Canceled -->

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
                            <th>
                                <div class="th-content">Category</div>
                            </th>
                            <th>
                                <div class="th-content text-left"></div>
                            </th>
                            <th>
                                <div class="th-content text-left">Title</div>
                            </th>
                            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <th>
                                <div class="th-content text-left">Jury</div>
                            </th>
                            @endif
                            <th>
                                <div class="th-content text-left">Deadline</div>
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
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($circular as $item)
                        @php
                        $deadlineDate = date('Y-m-d', strtotime($item['deadline']));
                        $currentDate = date('Y-m-d');

                        $expired_check = ($currentDate > $deadlineDate) ? true : false;
                        $submission_check = App\Models\Ebook::where(['circular_id'=> $item->id, 'author_id'=> Auth::user()->id])->count() > 0 ? true : false;
                        @endphp
                        <tr>
                            <td class="text-left">{{ $count++ }}</td>
                            <td>{{ $item['template_mave']->title }}</td>
                            <td class="text-left">
                                <img src="{{ url('/media/' . ($item->cover_image_mave ? $item->cover_image_mave->file_name : 'default_broken.jpg')) }}"
                                    class="rounded" alt="Responsive image" alt="" width="150px">
                            </td>
                            <td class="text-left">
                                <div class="d-flex align-items-center">{{ $item['title'] }}</div>
                            </td>
                            @if ((Auth::user()->role_id == 1 || Auth::user()->role_id == 2) && !empty($item->jury_members_mave))
                            <td>
                                @foreach ($item->jury_members_mave as $jury_mave)
                                <a href="#" class="text-danger remove_jury_member"
                                    data-action_type="remove" data-ebook_id="{{ $item->id }}"
                                    data-jury_id="{{ $jury_mave->id }}" title="Remove Jury">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <span>
                                    {{ $jury_mave->firstname . ' ' . $jury_mave->lastname }}
                                </span>
                                <br>
                                @endforeach
                            </td>
                            @endif
                            <td>{{ $expired_check == false ? date('d-m-Y', strtotime($item['deadline'])) : '' }}</td>

                            <td class="text-left">
                                @if($expired_check == false && $submission_check == false && Auth::user()->role_id != 3 && $item['status'] == 1)
                                <a href="{{ url('admin/circular_ebook/create/' . $item->template_mave->slug . '/' . $item['slug']) }}"
                                    class="badge badge-pill badge-success" role="button" title="Write Ebook">
                                    Write
                                </a>
                                @elseif ($submission_check == true)
                                <span class="badge badge-pill badge-warning">Submitted</span>
                                @elseif ($expired_check == true)
                                <span class="badge badge-pill badge-danger">Expired</span>
                                @else
                                <!-- <span class="badge badge-pill badge-danger"></span> -->
                                @endif
                            </td>
                            <td class="action_btn">
                                @if ($expired_check == false && (Auth::user()->role_id == 1 || Auth::user()->role_id == 2))
                                <a href="#" class="btn btn-info add_jury_member" role="button"
                                    title="Add Jury" data-toggle="modal" data-target="#juryMemberAdd"
                                    data-templete-title="{{ $item->title }}"
                                    data-ebook-id="{{ $item->id }}">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                </a>
                                <a href="{{ url('admin/circular_edit/') . '/' . $item['id'] }}"
                                    class="btn btn-warning" role="button" title="Edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a href="{{ url('admin/circular_delete/') . '/' . $item['slug'] }}"
                                    onclick="return confirm('Delete item?')" class="btn btn-danger"
                                    role="button" title="View">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="juryMemberAdd" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="juryMemberAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="juryMemberAddLabel">Add Jury</h5>
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
                                <option value="{{ $jury->id }}">
                                    {{ $jury->firstname . ' ' . $jury->lastname }}
                                </option>
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
        let URL = "{{ url('admin/circular_update_jury/') }}" + '/' + action_type;

        if (action_type == "remove") {
            data = {
                ebook_id: $(this).attr('data-ebook_id'),
                member_id: $(this).attr('data-jury_id')
            }
        }

        if (action_type == "add") {
            data = {
                ebook_id: $('#ebook_id').val(),
                member_id: $('#member_id').val()
            }
            $('#juryMemberAdd').modal('toggle');
        }


        let response = await custom_ajax('POST', URL, data);
        if (response.status == 200) {
            alert('Jury Updated Successfully!...');
        } else {
            alert('Something went wrong! Please try again later');
        }

    });
</script>
@endpush



<!-- Pending, Processing, Reviewed, Published, Draft, Revision -->
<!-- Pending, Processing, Published, Canceled -->

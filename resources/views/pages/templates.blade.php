@extends('layout.app')

@section('content')
<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">Ebook Categories</h5>
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
                                <div class="th-content text-left">Title</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($templates as $item)
                        <tr>
                            <td class="text-left">{{ $item->id }}</td>
                            <td class="text-left">{{ $item->title }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


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
                <input type="hidden" name="" value="0" id="templete_id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add_new_jury" data-action_type="add">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')

<script>
    $(document).on('click', '.add_jury_member', function(e) {
        e.preventDefault();
        $('#juryMemberAddLabel').text('Templete: ' + $(this).attr('data-templete-title'));
        $('#templete_id').val($(this).attr('data-templete-id'));
    });

    $(document).on('click', '#add_new_jury, .remove_jury_member', async function(e) {
        e.preventDefault();
        let data = {};
        let action_type = $(this).attr('data-action_type');
        let URL = "{{ url('admin/categories/update/')}}" + '/' + action_type;



        if (action_type == "remove") {
            data = {
                templete_id: $(this).attr('data-template_id'),
                member_id: $(this).attr('data-jury_id')
            }
        }

        if (action_type == "add") {
            data = {
                templete_id: $('#templete_id').val(),
                member_id: $('#member_id').val()
            }
            $('#juryMemberAdd').modal('toggle');
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

@extends('layout.app')

@section('content')
<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">User - List</h5>
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
                                <div class="th-content">Type</div>
                            </th>
                            <th>
                                <div class="th-content">Name</div>
                            </th>
                            <th>
                                <div class="th-content text-left">Phone</div>
                            </th>
                            <th>
                                <div class="th-content text-left">Email</div>
                            </th>
                            <th>
                                <div class="th-content text-left">Status</div>
                            </th>
                            <th>
                                <div class="th-content text-center">Action</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($count=1)
                        @foreach($users as $user)
                        <tr>
                            <td class="text-left">{{ $count++ }}</td>
                            <td>{{ $user->role_mave->title}}</td>
                            <td>
                                <img src="{{ asset( $user->profile_pic_mave? $user->profile_pic_mave->file_path : 'media/default.png' )}}" height="75px" width="75px" class="img-thumbnail rounded-circle" alt="">
                                {{ $user->firstname .' ' .$user->lastname }}
                            </td>
                            <td class="text-left">{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-left">{{ $user->status == 1 ? "Active" : "Inactive" }}</td>
                            <td class="action_btn text-center">
                                <a href="{{ url('admin/user/edit/' . $user->id) }}" class="btn btn-sm btn-warning btn-small">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" class="btn {{ $user->status == 1 ? 'btn-danger' : 'btn-success' }} btn-sm btn-small ban-user" title="{{ $user->status == 1 ? 'Disable' : 'Activate' }}" data-user-id="{{ $user->id }}" data-user-status="{{ $user->status }}">
                                    <i class="fa {{ $user->status == 1 ? 'fa-ban' : 'fa-check-square-o' }}"></i>
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

<script>
    $(document).on('click', '.ban-user', async function(e) {
        e.preventDefault();
        if (!confirm("Are you sure to change status of this user?")) {
            return false;
        }

        let new_status = ($(this).attr('data-user-status') == 0) ? 1 : 0;
        let URL = "{{ url('admin/user/update') }}" + "/" + $(this).attr('data-user-id');

        let DATA = {
            status: new_status
        };

        let response = await custom_ajax('POST', URL, DATA);
        if (response.status == 200) {
            Snackbar.show({
                text: 'User Updated Sucessfully.',
                pos: 'bottom-right',
                backgroundColor: "#35a598"
            });

            $(this).attr('data-user-status', new_status);
            $(this).toggleClass("btn-success btn-danger");
            $(this).find('i').toggleClass("fa-check-square-o fa-ban");
        }

    });
</script>


@endsection
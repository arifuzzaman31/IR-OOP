@extends('layout.app')

@section('content')
<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title }}</h5>
        </div>
        <div class="widget-body">
            <form action="{{ url('admin/user/update/'.$user->id)}}" method="POST" id="cf-form">
                @csrf
                <div class="row">
                    <div class="col-md-6 row">
                        <div class="col-md-12">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name" value="{{ $user->firstname }}" required="">
                        </div>
                        <div class="col-md-12">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name" value="{{ $user->lastname }}" required="">
                        </div>
                        <div class="col-md-12">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="{{ $user->phone }}">
                        </div>
                        <div class="col-md-12">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="{{ $user->email }}" required="">
                        </div>
                        @if($user->role_id == 1)
                        <div class="col-md-12">
                            <label for="role">Role {{ $user->role_id }}</label>
                            <select class="form-control" name="role_id" id="role_id">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="col-md-12 text-right mt-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @include('partials.upload_files', ['label' => "Profile Picture" , 'name' =>"profile_picture_id", 'value'=> $user->profile_picture_id , 'preview_url' => $user?->profile_pic_mave?->file_path , 'multiple' => false])
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">Change Password</h5>
        </div>
        <div class="widget-body">
            <form action="{{ url('admin/user/update/'.$user->id)}}" method="POST" class="cf-form">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter New password" value="" required="">
                    </div>
                    <div class="col-md-12">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter New password" value="" required="">
                    </div>
                    <div class="col-md-12 text-right mt-2">
                        <input type="hidden" name="form_type" value="update_password">
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(e) {
        let role_id = "{{ $user->role_id }}";
        $('#role_id').val(role_id).change();
    });
</script>


@endsection
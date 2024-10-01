@extends('layout.app')

@section('content')
<div class="section m-4">
    <div class="widget widget-table-two">
        <div class="widget-heading">
            <h5 class="">{{ $page_title }}</h5>
        </div>
        <div class="widget-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <div class="th-content">ID</div>
                            </th>
                            <th>
                                <div class="th-content">Type</div>
                            </th>
                            <th>
                                <div class="th-content">Name</div>
                            </th>
                            <th>
                                <div class="th-content">Phone</div>
                            </th>
                            <th>
                                <div class="th-content text-left">Email</div>
                            </th>
                            <th>
                                <div class="th-content text-left">Status</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $type }}</td>
                            <td>Nawal Shreya</td>
                            <td>+8813245645489</td>
                            <td>nawal@gmail.com</td>
                            <td class="btn pl-3 user_status_1" data-toggle="modal" data-target="#exampleModal">Active
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>{{ $type }}</td>
                            <td>Jeff Horton</td>
                            <td>+91546576541</td>
                            <td>jeff@gmail.com</td>
                            <td class="btn pl-3 user_status_2" data-toggle="modal" data-target="#exampleModal">Inactive
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>{{ $type }}</td>
                            <td>Julian Soler</td>
                            <td>+15768574254</td>
                            <td>julian@gmail.com</td>
                            <td class="btn pl-3 user_status_3" data-toggle="modal" data-target="#exampleModal">Active
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="inputState">Status</label>
                    <select id="inputState" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
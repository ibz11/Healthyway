
@include('Panel/Admin/header')

<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">USERS</h6>
                            <button type="button" class="show btn btn-primary text-light" data-bs-toggle="modal" data-bs-target="#createuserModal">Create a USER</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full names</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                           
                                            <th>Role</th>
                                            <th>Created at</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($users as $users)
                                        <tr>
                                            <td>{{$users->id}}</td>
                                            <td>{{$users->full_name}}</td>
                                            <td>{{$users->email}}</td>
                                            <td>{{$users->phone}}</td>
                                            <td><span class="badge bg-dark text-light">{{$users->role}}</span></td>
                                            <td>{{$users->created_at}}</td>

                                            <td><a href="{{URL('updateuser',$users->id)}}" class="btn btn-outline-success">Update</a></td>
                                            <td><a href="{{URL('deleteuser',$users->id)}}" class="btn btn-outline-danger">Delete</a></td>
                                        </tr>
                                    @endforeach
                                      
                                 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


@include('Panel/Admin/modals/createuser')

 @include('Panel/Admin/footer')
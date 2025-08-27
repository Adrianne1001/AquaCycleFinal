@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Users</h1>
    <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-user">Add New User</a>
    <br><br>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Published Articles
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>                  
                        <th>Name</th>
                        <th>Year Level</th>
                        <th>ID Number</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>                  
                        <th>Name</th>
                        <th>Year Level</th>
                        <th>ID Number</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->year_level }}</td>
                        <td>{{ $user->id_number }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary edit-user" data-id="{{ $user->id }}">Edit</a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach              
                </tbody>
            </table>
        </div>
    </div>    
</div>

<div class="modal fade" id="ajax-user-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Make the modal wider -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form id="userForm" name="userForm" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="_method" id="method" value="POST">

                    
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Account Unique ID</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="account_id" name="account_id"  value="" placeholder="This is Auto-Generated Field" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter User Name" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="year_level" class="col-sm-4 control-label">Year Level</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="year_level" name="year_level" required="">
                                <option value="">Select Year Level</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_number" class="col-sm-4 control-label">ID Number</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="id_number" name="id_number" placeholder="Enter ID Number" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter User Email" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="password" name="password" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-sm-4 control-label">Role</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="role" name="role" required="">
                                <option value="">Select Year Level</option>
                                <option value="Admin">Admin</option>
                                <option value="Student">Student</option>
                                <option value="Student">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save" style="margin-top: 10px;"></button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#create-new-user').click(function() {
            $('#userForm').trigger("reset"); 
            $('#ajax-user-modal').modal('show'); 
            $('#userCrudModal').html("Add User");
            $('#btn-save').text('Save User'); 
            $('#password').attr('placeholder', 'Enter Password');
            $('#method').val('POST'); 
            $('#userForm').attr('action', "{{ route('user.store') }}"); 
        });

        $('body').on('click', '.edit-user', function() {
            var user_id = $(this).data('id');
            $.get("{{ route('user.index') }}" + '/' + user_id + '/edit', function(data) {
                $('#userCrudModal').html("Edit User");
                $('#method').val('PUT'); 
                $('#user_id').val(data.id); 
                $('#account_id').val(data.account_id); 
                $('#name').val(data.name); 
                $('#year_level').val(data.year_level);
                $('#id_number').val(data.id_number);
                $('#email').val(data.email);
                $('#role').val(data.role);
                $('#password').val("");
                $('#password').attr('placeholder', 'Enter New Password (leave blank to keep current)');
                $('#userForm').attr('action', "{{ route('user.update', '') }}/" + data.id); 
                $('#btn-save').text('Update User'); 
                $('#ajax-user-modal').modal('show'); 
            });
        });

        $('#userForm').on('submit', function(e) {
            e.preventDefault(); 
            let formData = new FormData(this); 

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: (data) => {
                    $('#ajax-user-modal').modal('hide');
                    location.reload(); 
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    });
</script>

@endsection

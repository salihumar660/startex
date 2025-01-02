@include('admin.component.header')
{{-- @include('admin.component.style') --}}
@include('admin.component.topnav')
@include('admin.component.navbar')




<div class="content-body">
    <div class="container-fluid mt-3">

        <div class="row">

            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Users</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$users}}</h2>
                            {{-- <p class="text-white mb-0">Jan - March 2019</p> --}}
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>

        </div>


        <div class="row mt-4">
            <div class="col">
                <div class="card" style="overflow:auto; width:100% !important;">
                    <div class="card-header">
                        <div  class="col-md-12" style="background:white;  display: flex;  flex-wrap: wrap; flex-direction: row; justify-content: space-between;">

                            <p style="margin-top: 14px;"><i class="fa fa-user"></i>  <button class="btn btn-sm  btn-info ml-2 my-3 add" type="button">Add User</button></p>


                            <form id="filter-form" style="display:flex; align-items:center;  flex-wrap: nowrap; justify-content: space-between; margin-bottom: 0px;">

                                <label for="from_date" class="me-2 h4"  ></label>
                                <input type="date" id="from_date"class="me-2 form-control"   name="from_date"  style="width:40%;">

                                <label for="to_date" class="me-2 h4" >-</label>
                                <input type="date" id="to_date" class="me-2 form-control" name="to_date"  style="width:40%;">

                                <button type="submit" class=" me-2 btn btn-primary" style="padding: 9px;"><i class="fas fa-check"></i></button>

                            </form>

                        </div>

                    </div>


                    <div class="card-body" v-cloak>

                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>success</strong> &nbsp; {{ session()->get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif



                        <div class="table-responsive">
                            <table class="table table-hover user-listing table-listing table-hover " style=" width:100%;">
                                <thead>
                                    <tr>

                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>


                                        <th>Created At</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>



                    </div>


                </div>
            </div>
        </div>




          {{-- add user --}}
          <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <form id="addUserForm" enctype="multipart/form-data">
                            <div id="sending-message" class="text-danger fw-bold"></div>
                            <br>
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="form-group col-md-12">

                                    <label class="control-label">Name</label>
                                    <input type="text" name="user_name" id="user_name" class="form-control" required>
                                    <label class="control-label">Email
                                    *</label>
                                    <input type="email" name="user_email" id="user_email" class="form-control" required>
                                    <label class="control-label">Password *</label>
                                    <input type="password" name="user_password" id="user_password" class="form-control" required>
                                    <label class="control-label">Role</label>

                                <select name="role_id" id="role_id" class="form-select">
                                    <option selected disabled>Select Branch</option>

                                    <option value="2">Sub Admin</option>
                                    <option value="3">Supplier</option>

                                </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




    {{-- update user --}}
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" saria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">

            <div class="modal-content ">

                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" +data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-dark">

                    <input type="hidden" name="user_id" id="user_id">

                    <div id="update-message" class="text-danger fw-bold"></div>

                    <div class="row d-flex justify-content-center align-items-center">


                        <div class="form-group col-md-12">


                            <label class="control-label">Role</label>
                            <select name="update_role_id" id="update_role_id" class="form-select">
                                <option selected disabled>Select Branch</option>
                                {{-- @foreach ($branches as $branch)
                                @endforeach --}}
                                <option value="2">Sub Admin</option>
                                <option value="3">Supplier</option>

                            </select>
                                <label class="control-label">Name</label>
                                <input type="text" name="update_name" id="update_name" class="form-control">

                                <label class="control-label">Email</label>
                                <input type="email" name="update_email" id="update_email" class="form-control">


                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-lg-right " id="updateBtn">Submit</button>

                </div>

            </div>
        </div>
    </div>
    </div>

</div>



@include('admin.component.footer')


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">





<script type="text/javascript">
    $(function() {
        setTimeout(function() {
            var table = $('.user-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/users-list') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    }
                },

                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roleName',
                        name: 'roleName'
                    },

                    {
                        data: 'created',
                        name: 'created'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [[0, 'desc']],
            });

            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                $('.user-listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script>




<script>
   $(document).ready(function() {
    $('.add').click(function() {
        $('#addUser').modal('show');
    });

    $('#addUserForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(form[0]);

        $('#sending-message').text('Processing request, please wait...');

        $.ajax({
            url: "{{ url('/add-user') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#sending-message').text(response.success);
                // Reload the DataTable or update the UI as necessary
                $('.user-listing').DataTable().ajax.reload();
            },
            error: function(xhr) {
                $('#sending-message').text('Error occurred. Please try again.');
                console.log(xhr.responseText);
            },
            complete: function() {
                $('#addUser').modal('hide');
                $('#sending-message').text('');
            }
        });
    });
});

</script>




{{--  edit user --}}
<script>
    $(document).ready(function() {

        $(document).on('click', '.edit', function() {
            var userId = $(this).val();

            $('#editUser').modal('show');

            $.ajax({
                type: "GET",
                url: "edit-user/" + userId,
                success: function(response) {

                    $('#user_id').val(userId);

                    $('#update_name').val(response.user.name);
                    $('#update_role_id').val(response.user.role_id);
                    $('#update_email').val(response.user.email);

                    // console.log(response);
                    // console.log(response.user.type);

                }
            });
        });
    });
</script>





{{-- update country --}}

<script>
    $(document).ready(function() {
        $('#updateBtn').on('click', function() {

            var userId = $('#user_id').val();

            var name = $('#update_name').val();
            var email = $('#update_email').val();
            var role_id = $('#update_role_id').val();



            $('#update-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/update-user') }}",
                type: 'GET',
                data: {
                    'userId': userId,
                    'name': name,
                    'email': email,
                    'role_id': role_id,
                },
                success: function(response) {},

                error: function(xhr) {

                    $('#update-message').text(xhr);
                },
                complete: function() {
                    $('#update-message').text('');
                    $('#editUser').modal('hide');
                    // location.reload();
                    $('.user-listing').DataTable().ajax.reload();
                }
            });

        });
    });
</script>

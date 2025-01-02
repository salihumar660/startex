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
                        <h3 class="card-title text-white">Driver</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$drivers}}</h2>
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

                            <p style="margin-top: 14px;"><i class="fa fa-user"></i>  <button class="btn btn-sm  btn-info ml-2 my-3 add" type="button">
                                Add Driver</button></p>


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
                            <table class="table table-hover driver-listing table-listing table-hover " style=" width:100%;">
                                <thead>
                                    <tr>

                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Zip</th>
                                        <th>Transport Company</th>
                                        <th>Status</th>


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




          {{-- add Driver --}}
          <div class="modal fade" id="addDriver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Add Driver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <form id="addDriverForm" enctype="multipart/form-data">
                            <div id="sending-message" class="text-danger fw-bold"></div>
                            <br>
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="form-group col-md-12">


                                    <label class="control-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                    <label class="control-label">Email *</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                    <label class="control-label">password *</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                    <label class="control-label">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" required>
                                    <label class="control-label">State</label>
                                    <input type="text" name="state" id="state" class="form-control" required>
                                    <label class="control-label">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" required>
                                    <label class="control-label">City</label>
                                    <input type="text" name="city" id="city" class="form-control" required>
                                    <label class="control-label">Zip</label>
                                    <input type="text" name="zip" id="zip" class="form-control" required>
                                    <label class="control-label">Tranport Company</label>
                                    <input type="text" name="transport_company" id="transport_company" class="form-control" required>
                                    <label class="control-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="" selected  disabled>Select status</option>
                                        <option value="Active">Active</option>
                                        <option value="Block">Block</option>
                                    </select>
                                    {{-- <label class="control-label">Transport</label>

                                    <select name="transport_id" id="transport_id" class="form-select">
                                        <option value="" selected disabled>Select  transport</option>
                                        @foreach (@$transport  as  $trans)

                                            <option value="{{ @$trans->id }}">{{ @$trans->company_name	}}</option>
                                        @endforeach
                                    </select> --}}

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
    <div class="modal fade" id="editDriver" tabindex="-1" role="dialog" saria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">

            <div class="modal-content ">

                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit user</h5>
                    <button type="button" class="close" +data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-dark">

                    <input type="hidden" name="user_id" id="user_id">

                    <div id="update-message" class="text-danger fw-bold"></div>

                    <div class="row d-flex justify-content-center align-items-center">


                        <div class="form-group col-md-12">


                            <label class="control-label">Name</label>
                            <input type="text" name="update_name" id="update_name" class="form-control" required>
                            <label class="control-label">Email *</label>
                            <input type="email" name="update_email" id="update_email" class="form-control" required>
                            <label class="control-label">Password *</label>
                            <input type="password" name="update_password" id="update_password" class="form-control" required>
                            <label class="control-label">Phone</label>
                            <input type="text" name="update_phone" id="update_phone" class="form-control" required>
                            <label class="control-label">State</label>
                            <input type="text" name="update_state" id="update_state" class="form-control" required>
                            <label class="control-label">Address</label>
                            <input type="text" name="update_address" id="update_address" class="form-control" required>
                            <label class="control-label">City</label>
                            <input type="text" name="update_city" id="update_city" class="form-control" required>
                            <label class="control-label">Zip</label>
                            <input type="text" name="update_zip" id="update_zip" class="form-control" required>
                            <label class="control-label">Tranport Company</label>
                            <input type="text" name="update_transport_company" id="update_transport_company" class="form-control" required>
                            <label class="control-label">Status</label>
                            <select name="update_status" id="update_status" class="form-select">
                                <option value="Active">Active</option>
                                <option value="Block">Block</option>
                            </select>

                            {{-- <label class="control-label">Transport</label>

                            <select name="update_transport_id" id="update_transport_id" class="from-control">
                                <option value="" selected disabled>Select  transport</option>
                                @foreach (@$transport  as  $trans)

                                    <option value="{{ @$trans->id }}">{{ @$trans->company_name	}}</option>
                                @endforeach
                            </select> --}}

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
            var table = $('.driver-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/driverDetail-list') }}",
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
                        data: 'driver.phone',
                        name: 'driver.phone'
                    },
                    {
                        data: 'driver.address',
                        name: 'driver.address'
                    },
                    {
                        data: 'driver.city',
                        name: 'driver.city'
                    },
                    {
                        data: 'driver.state',
                        name: 'driver.state'
                    },
                    {
                        data: 'driver.zip',
                        name: 'driver.zip'
                    },
                    {
                        data: 'driver.transport_company',
                        name: 'driver.transport_company'
                    },
                    {
                        data: 'driver.status',
                        name: 'driver.status'
                    },
                    // {
                    //     data: 'driver.transport.company_name',
                    //     name: 'driver.transport.company_name'
                    // },

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
                $('.driver-listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script>




<script>
   $(document).ready(function() {
    $('.add').click(function() {
        $('#addDriver').modal('show');
    });

    $('#addDriverForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(form[0]);

        $('#sending-message').text('Processing request, please wait...');

        $.ajax({
            url: "{{ url('/add-driverDetail') }}",
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
                $('.driver-listing').DataTable().ajax.reload();
            },
            error: function(xhr) {
                $('#sending-message').text('Error occurred. Please try again.');
                console.log(xhr.responseText);
            },
            complete: function() {
                $('#addDriver').modal('hide');
                $('#sending-message').text('');
            }
        });
    });
});

</script>




{{--  edit --}}
<script>
    $(document).ready(function() {

        $(document).on('click', '.edit', function() {
            var userId = $(this).val();

            $('#editDriver').modal('show');

            $.ajax({
                type: "GET",
                url: "edit-driverDetail/" + userId,
                success: function(response) {

                    $('#user_id').val(userId);

                    $('#update_name').val(response.user.name);
                    $('#update_phone').val(response.user.driver.phone);
                    $('#update_address').val(response.user.driver.address);
                    $('#update_city').val(response.user.driver.city);
                    $('#update_state').val(response.user.driver.state);
                    $('#update_zip').val(response.user.driver.zip);
                    $('#update_transport_company').val(response.user.driver.transport_company);
                    $('#update_email').val(response.user.email);
                    // $('#update_transport_id').val(response.user.driver.transport_id);
                    $('#update_status').val(response.user.driver.status);

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
            var phone = $('#update_phone').val();
            var address = $('#update_address').val();
            var city = $('#update_city').val();
            var state = $('#update_state').val();
            var zip = $('#update_zip').val();
            // var transport_id = $('#update_transport_id').val();
            var transport_company = $('#update_transport_company').val();
            var status = $('#update_status').val();

            $('#update-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/update-driverDetail') }}",
                type: 'GET',
                data: {
                    'userId': userId,
                    'name': name,
                    'email': email,
                    'phone': phone,
                    'address': address,
                    'city': city,
                    'state': state,
                    'zip': zip,
                    // 'transport_id': transport_id,
                    'transport_company': transport_company,
                    'status': status,
                },
                success: function(response) {},

                error: function(xhr) {

                    $('#update-message').text(xhr);
                },
                complete: function() {
                    $('#update-message').text('');
                    $('#editDriver').modal('hide');
                    // location.reload();
                    $('.driver-listing').DataTable().ajax.reload();
                }
            });

        });
    });
</script>

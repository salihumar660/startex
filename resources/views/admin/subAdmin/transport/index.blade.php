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
                        <h3 class="card-title text-white">Transport</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$transports}}</h2>
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
                                Add Transport</button></p>


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
                            <table class="table table-hover transport-listing table-listing table-hover " style=" width:100%;">
                                <thead>
                                    <tr>

                                        <th>Id</th>
                                        <th>Company Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Fax</th>
                                        <th>ppy_code</th>
                                        <th>Fuel Sur charge</th>
                                        <th>Insurance</th>
                                        <th>Other</th>
                                        <th>Code</th>
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
          <div class="modal fade" id="addTransport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Add transport</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <form id="addTransportForm" enctype="multipart/form-data">
                            <div id="sending-message" class="text-danger fw-bold"></div>
                            <br>
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="form-group col-md-12">


                                    <label class="control-label">Company Name</label>
                                    <input type="text" name="company_name" id="company_name" class="form-control" required>
                                    <label class="control-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                    <label class="control-label">Fax</label>
                                    <input type="text" name="fax" id="fax" class="form-control" required>
                                    <label class="control-label">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" required>
                                    <label class="control-label">PPY_Code</label>
                                    <input type="text" name="ppy_code" id="ppy_code" class="form-control" required>
                                    <label class="control-label">Fuel Sur Charge</label>
                                    <input type="text" name="fuel_sur_charge" id="fuel_sur_charge" class="form-control" required>
                                    <label class="control-label">Insurance</label>
                                    <input type="text" name="insurance" id="insurance" class="form-control" required>
                                    <label class="control-label">Other</label>
                                    <input type="text" name="other" id="other" class="form-control" required>
                                    <label class="control-label">Code</label>
                                    <input type="text" name="code" id="code" class="form-control" required>
                                    <label class="control-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="Active">Active</option>
                                        <option value="Block">Block</option>
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




    {{-- update --}}
    <div class="modal fade" id="editTransport" tabindex="-1" role="dialog" saria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">

            <div class="modal-content ">

                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Transport</h5>
                    <button type="button" class="close" +data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-dark">

                    <input type="text" name="transport_id" id="transport_id">

                    <div id="update-message" class="text-danger fw-bold"></div>

                    <div class="row d-flex justify-content-center align-items-center">


                        <div class="form-group col-md-12">


                            <label class="control-label">Company Name</label>
                            <input type="text" name="update_company_name" id="update_company_name" class="form-control" required>
                            <label class="control-label">Email</label>
                            <input type="email" name="update_email" id="update_email" class="form-control" required>
                            <label class="control-label">Fax</label>
                            <input type="text" name="update_fax" id="update_fax" class="form-control" required>
                            <label class="control-label">Phone</label>
                            <input type="text" name="update_phone" id="update_phone" class="form-control" required>
                            <label class="control-label">PPY_Code</label>
                            <input type="text" name="update_ppy_code" id="update_ppy_code" class="form-control" required>
                            <label class="control-label">Fuel Sur Charge</label>
                            <input type="text" name="update_fuel_sur_charge" id="update_fuel_sur_charge" class="form-control" required>
                            <label class="control-label">Insurance</label>
                            <input type="text" name="update_insurance" id="update_insurance" class="form-control" required>
                            <label class="control-label">Other</label>
                            <input type="text" name="update_other" id="update_other" class="form-control" required>
                            <label class="control-label">Code</label>
                            <input type="text" name="update_code" id="update_code" class="form-control" required>
                            <label class="control-label">Status</label>
                            <select name="update_status" id="update_status" class="form-select">
                                <option value="Active">Active</option>
                                <option value="Block">Block</option>
                            </select>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-lg-right " id="updateBtn">submit</button>

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
            var table = $('.transport-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/transport-list') }}",
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
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'fax',
                        name: 'fax'
                    },
                    {
                        data: 'ppy_code',
                        name: 'ppy_code'
                    },
                    {
                        data: 'fuel_sur_charge',
                        name: 'fuel_sur_charge'
                    },
                    {
                        data: 'insurance',
                        name: 'insurance'
                    },
                    {
                        data: 'other',
                        name: 'other'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
                $('.transport-listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script>




<script>
   $(document).ready(function() {
    $('.add').click(function() {
        $('#addTransport').modal('show');
    });

    $('#addTransportForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(form[0]);

        $('#sending-message').text('Processing request, please wait...');

        $.ajax({
            url: "{{ url('/add-transport') }}",
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
                $('.transport-listing').DataTable().ajax.reload();
            },
            error: function(xhr) {
                $('#sending-message').text('Error occurred. Please try again.');
                console.log(xhr.responseText);
            },
            complete: function() {
                $('#addTransport').modal('hide');
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
            var transportId = $(this).val();


            $('#editTransport').modal('show');

            $.ajax({
                type: "GET",
                url: "edit-transport/" + transportId,
                success: function(response) {

                    $('#transport_id').val(transportId);

                    $('#update_company_name').val(response.transport.company_name);
                    $('#update_email').val(response.transport.email);
                    $('#update_phone').val(response.transport.phone);
                    $('#update_fax').val(response.transport.fax);
                    $('#update_ppy_code').val(response.transport.ppy_code);
                    $('#update_fuel_sur_charge').val(response.transport.fuel_sur_charge);
                    $('#update_insurance').val(response.transport.insurance);
                    $('#update_other').val(response.transport.other);
                    $('#update_code').val(response.transport.code);
                    $('#update_status').val(response.transport.status);

                    // console.log(response);
                    // console.log(response.user.type);

                }
            });
        });
    });
</script>





{{-- update  --}}

<script>
    $(document).ready(function() {
        $('#updateBtn').on('click', function() {

            var transportId = $('#transport_id').val();

            var  company_name=  $('#update_company_name').val();
            var  email  =   $('#update_email').val();
            var   phone = $('#update_phone').val();
            var  fax =  $('#update_fax').val();
            var  ppy_code =  $('#update_ppy_code').val();
            var  fuel_sur_charge =  $('#update_fuel_sur_charge').val();
            var  insurance = $('#update_insurance').val();
            var  other =  $('#update_other').val();
            var  code =  $('#update_code').val();
            var  status =  $('#update_status').val();


            $('#update-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/update-transport') }}",
                type: 'GET',
                data: {
                    'transportId': transportId,
                    'company_name': company_name,
                    'email': email,
                    'phone': phone,
                    'fax': fax,
                    'ppy_code': ppy_code,
                    'fuel_sur_charge': fuel_sur_charge,
                    'insurance': insurance,
                    'other': other,
                    'code': code,
                    'status': status,
                },
                success: function(response) {},

                error: function(xhr) {

                    $('#update-message').text(xhr);
                },
                complete: function() {
                    $('#update-message').text('');
                    $('#editTransport').modal('hide');
                    // location.reload();
                    $('.transport-listing').DataTable().ajax.reload();
                }
            });

        });
    });
</script>

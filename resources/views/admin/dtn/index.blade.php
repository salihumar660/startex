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
                        <h3 class="card-title text-white">Dtn</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$dtn}}</h2>

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
                        <div  class="col-sm-12" style="background:white;  display: flex;  flex-wrap: wrap; flex-direction: row; justify-content: space-between;">

                            <p style="margin-top: 14px;"><i class="fa fa-user"></i>  <button class="btn btn-sm  btn-info ml-2 my-3 add" type="button">+</button></p>


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
                            <table class="table table-hover dtn-listing table-listing table-hover " style=" width:100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Brand</th>
                                        <th>Order</th>
                                        <th>Terminal zone</th>
                                        <th>Transport</th>
                                        <th>Date</th>
                                        <th>Rack</th>
                                        <th>Commission</th>
                                        <th>Bol</th>
                                        <th>Created at</th>
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




          {{-- add customer --}}
          <div class="modal fade" id="addDtn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">add customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <form id="addDtnForm" enctype="multipart/form-data">
                            <div id="sending-message" class="text-danger fw-bold"></div>
                            <br>
                            <div class="row d-flex justify-content-center align-items-center bg-light">
                                <div class="form-group col-md-6">


                                    <label class="control-label">Brand</label>
                                    <input type="text" name="brand" id="brand" class="form-control" required>

                                </div>
                                <div class="form-group col-md-6">

                                    <label class="control-label">Order</label>
                                    <input type="text" name="order" id="order" class="form-control" required>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Terminal Zone</label>
                                    <input type="text" name="terminal_zone" id="terminal_zone" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Transport</label>
                                    <input type="text" name="transport" id="transport" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Date</label>
                                    <input type="text" name="date" id="date" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Rack</label>
                                    <input type="text" name="rack" id="rack" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Commission</label>
                                    <input type="text" name="commission" id="commission" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Bol</label>
                                    <input type="text" name="bol" id="bol" class="form-control" required>
                                </div>

                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">submit</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




  {{-- update  --}}
<div class="modal fade" id="editDtn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <input type="hidden" name="dtn_id" id="dtn_id">
                <div id="update-message" class="text-danger fw-bold"></div>
                <div class="row d-flex justify-content-center align-items-center bg-light">
                    <div class="form-group col-md-6">


                        <label class="control-label">Brand</label>
                        <input type="text" name="update_brand" id="update_brand" class="form-control" required>

                    </div>
                    <div class="form-group col-md-6">

                        <label class="control-label">Order</label>
                        <input type="text" name="update_order" id="update_order" class="form-control" required>

                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Terminal Zone</label>
                        <input type="text" name="update_terminal_zone" id="update_terminal_zone" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Transport</label>
                        <input type="text" name="update_transport" id="update_transport" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Date</label>
                        <input type="text" name="update_date" id="update_date" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Rack</label>
                        <input type="text" name="update_rack" id="update_rack" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Commission</label>
                        <input type="text" name="update_commission" id="update_commission" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Bol</label>
                        <input type="text" name="update_bol" id="update_bol" class="form-control" required>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary float-lg-right" id="updateBtn">Submit</button>
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
            var table = $('.dtn-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/dtn-list') }}",
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
                        data: 'brand',
                        name: 'brand'
                    },
                    {
                        data: 'order',
                        name: 'order'
                    },
                    {
                        data: 'terminal_zone',
                        name: 'terminal_zone'
                    },
                    {
                        data: 'transport',
                        name: 'transport'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'rack',
                        name: 'rack'
                    },
                    {
                        data: 'commission',
                        name: 'commission'
                    },
                    {
                        data: 'bol',
                        name: 'bol'
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
                $('.dtn-listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script>




<script>
   $(document).ready(function() {
    $('.add').click(function() {
        $('#addDtn').modal('show');
    });

    $('#addDtnForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(form[0]);

        $('#sending-message').text('Processing request, please wait...');

        $.ajax({
            url: "{{ url('/add-dtn') }}",
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
                $('.dtn-listing').DataTable().ajax.reload();
            },
            error: function(xhr) {
                $('#sending-message').text('Error occurred. Please try again.');
                console.log(xhr.responseText);
            },
            complete: function() {
                $('#addDtn').modal('hide');
                $('#sending-message').text('');
            }
        });
    });
});

</script>



<script>
    $(document).ready(function() {
        // Load customer data into modal
        $(document).on('click', '.edit', function() {
            var dtnId = $(this).val();
            $('#editDtn').modal('show');

            $.ajax({
                type: "GET",
                url: "edit-dtn/" + dtnId,
                success: function(response) {
                    console.log(response);

                    $('#dtn_id').val(dtnId);
                    $('#update_brand').val(response.dtn.brand);
                    $('#update_order').val(response.dtn.order);
                    $('#update_terminal_zone').val(response.dtn.terminal_zone);
                    $('#update_transport').val(response.dtn.transport);
                    $('#update_date').val(response.dtn.date);
                    $('#update_rack').val(response.dtn.rack);
                    $('#update_commission').val(response.dtn.commission);
                    $('#update_bol').val(response.dtn.bol);

                }
            });
        });

        // Handle update button click
        $('#updateBtn').on('click', function() {
            var dtnId = $('#dtn_id').val();
            var brand = $('#update_brand').val();
            var order = $('#update_order').val();
            var terminal_zone = $('#update_terminal_zone').val();
            var transport = $('#update_transport').val();
            var date = $('#update_date').val();
            var rack = $('#update_rack').val();
            var commission = $('#update_commission').val();
            var bol = $('#update_bol').val();

            $('#update-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/update-dtn') }}",
                type: 'GET',
                data: {
                    dtnId: dtnId,
                    brand: brand,
                    order: order,
                    terminal_zone: terminal_zone,
                    transport: transport,
                    date: date,
                    rack: rack,
                    commission: commission,
                    bol: bol,

                },
                success: function(response) {
                    // Handle success response
                    $('#editDtn').modal('hide');
                    $('.dtn-listing').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    $('#update-message').text('Error: ' + xhr.responseText);
                },
                complete: function() {
                    $('#update-message').text('');
                }
            });
        });
    });
</script>


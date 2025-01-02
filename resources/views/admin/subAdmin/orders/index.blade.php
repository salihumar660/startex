@include('admin.component.header')
{{-- @include('admin.component.style') --}}
@include('admin.component.topnav')
@include('admin.component.navbar')

<div class="content-body">
    <div class="container-fluid mt-3">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="row mt-4">
                        <div class="col">
                            <div class="card" style="overflow:auto; width:100% !important;">
                                <h3 class="text-center m-2"> GAS ORDERS</h3>
                                <div class="card-header">
                                    <div class="col-md-12"
                                        style="background:white;  display: flex;  flex-wrap: wrap; flex-direction: row; justify-content: space-between;">

                                        <p style="margin-top: 14px;"><i class="fa fa-cart"></i> <a href="{{ '/all-export-invoice' }}" class="btn btn-primary">Export Excel</a> </p>


                                        <form id="filter-form"
                                            style="display:flex; align-items:center;  flex-wrap: nowrap; justify-content: space-between; margin-bottom: 0px;">

                                            <label for="from_date" class="me-2 h4"></label>
                                            <input type="date" id="from_date"class="me-2 form-control"
                                                name="from_date" style="width:40%;">

                                            <label for="to_date" class="me-2 h4">-</label>
                                            <input type="date" id="to_date" class="me-2 form-control"
                                                name="to_date" style="width:40%;">

                                            <button type="submit" class=" me-2 btn btn-primary"
                                                style="padding: 9px;"><i class="fas fa-check"></i></button>

                                        </form>

                                    </div>

                                </div>


                                <div class="card-body" v-cloak>



                                    <div class="table-responsive">
                                        <table class="table table-hover order_listing table-listing table-hover "
                                            style=" width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Customer</th>
                                                    <th>Transport</th>
                                                    <th>Gallon</th>
                                                    <th>Address</th>
                                                    <th>Date</th>
                                                    <th>Type of oil</th>
                                                    <th>Status</th>
                                                    <th>Company</th>
                                                   <th>Created At</th>
                                                    <th>Delivery Ticket</th>
                                                    <th>Invoice</th>
                                                    <th>Excel</th>
                                                    <th>
                                                        Action
                                                    </th>

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

                </div>
            </div>
        </div>


        {{-- assign order to driver --}}
        <div class="modal fade" id="assignOrder" tabindex="-1" role="dialog" saria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">

                <div class="modal-content ">

                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Assign Driver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-dark">

                        {{-- <input type="hidden" name="order_id" id="order_id"> --}}

                        <div id="update-message" class="text-danger fw-bold"></div>

                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="form-group col-md-12">

                                <input type="hidden" name="order_id" id="order_id" class="form-control">

                                <label class="control-label">Driver</label>
                                <select name="driver_id" id="driver_id" class="form-select">
                                    <option value="" selected disabled>Select Driver</option>
                                    @foreach ($drivers as $drive)
                                        <option value="{{ $drive->id }}">{{ $drive->name }}</option>
                                    @endforeach

                                </select>





                                <label class="control-label">Company</label>
                                <select name="company" id="company" class="form-select" required>
                                    <option value="" selected disabled>Select Comapny</option>
                                    <option value="Phillips">Phillips</option>
                                    <option value="Valero">Valero </option>
                                    <option value="Global">Global</option>
                                    <option value="NGL Crude">NGL Crude</option>
                                    <option value="Motiva">Motiva</option>
                                    <option value="Shell">Shell</option>
                                </select>


                                <label class="control-label">Transport</label>

                                <select name="transport_id" id="transport_id" class="form-select" required>
                                    <option value="" selected disabled>Select  transport</option>
                                    @foreach (@$transport  as  $trans)

                                        <option value="{{ @$trans->id }}">{{ @$trans->company_name	}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary float-lg-right " id="updateBtn">SUBMIT</button>

                    </div>

                </div>
            </div>
        </div>


        {{-- chagne status--}}
        <div class="modal fade" id="changeStatus" tabindex="-1" role="dialog" saria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">

                <div class="modal-content ">

                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Change Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-dark">


                        <div id="update-message" class="text-danger fw-bold"></div>

                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="form-group col-md-12">

                                <input type="hidden" name="order_id" id="order_id" class="form-control">

                                <label class="control-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="" selected disabled>Select Driver</option>
                                    <option value="pending">Pending</option>
                                    <option value="assign">Assign</option>
                                    <option value="delivered">Deliverd</option>


                                </select>

                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary float-lg-right " id="updateStatus">UPDATE</button>

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




{{-- data table  --}}
<script type="text/javascript">
    $(function() {
        setTimeout(function() {
            var table = $('.order_listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/order-to-driver-list') }}",
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
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'transport.company_name',
                        name: 'transport.company_name'
                    },
                    {
                        data: 'gallon',
                        name: 'gallon'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },

                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'type_of_oil',
                        name: 'type_of_oil'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'company',
                        name: 'company'
                    },

                    {
                        data: 'created_by',
                        name: 'created_by'
                    },
                    {
                        data: 'delivery_ticket',
                        name: 'delivery_ticket'
                    },
                    {
                        data: 'invoice',
                        name: 'invoice'
                    },
                    {
                        data: 'excel',
                        name: 'excel'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ],
                order: [
                    [0, 'desc']
                ],
            });

            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                $('.order_listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script>





{{--  assign order --}}
<script>
    $(document).ready(function() {
        $(document).on('click', '.edit', function() {
            var orderId = $(this).val();


            $('#assignOrder').modal('show');

            $.ajax({
                type: "GET",
                url: "edit-assign-order/" + orderId,
                success: function(response) {
                    $('#order_id').val(orderId);
                    $('#company').val(response.order.company);
                    $('#transport_id').val(response.order.transport_id);

                    if (response.orderAssign && response.orderAssign.user_id) {
                        $('#driver_id').val(response.orderAssign.user_id);
                    } else {
                        $('#driver_id').val('');
                    }
                }
            });
        });
    });
</script>



{{-- update Order assign --}}


<script>
    $(document).ready(function() {
        $('#updateBtn').on('click', function() {

            var orderId = $('#order_id').val();

            var driver_id = $('#driver_id').val();
            var status = $('#status').val();
            var company = $('#company').val();
            var transport_id = $('#transport_id').val();

            $('#update-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/update-order-assign') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    orderId: orderId,
                    driver_id: driver_id,
                    company: company,
                    transport_id: transport_id,

                },
                success: function(response) {
                    $('#update-message').text('Update successful!');
                },
                error: function(xhr) {
                    $('#update-message').text('Error: ' + xhr.responseText);
                },
                complete: function() {
                    $('#assignOrder').modal('hide');
                    $('#update-message').text('');
                    $('.order_listing').DataTable().ajax.reload();
                }
            });
        });
    });
</script>




{{--  edit status --}}
<script>
    $(document).ready(function() {
        $(document).on('click', '.statusForm', function() {
            var orderId = $(this).val();


            $('#changeStatus').modal('show');

            $.ajax({
                type: "GET",
                url: "edit-order-status/" + orderId,
                success: function(response) {
                    $('#order_id').val(orderId);

                    $('#status').val(response.order.status);

                }
            });
        });
    });
</script>



{{-- update status --}}


<script>
    $(document).ready(function() {
        $('#updateStatus').on('click', function() {

            var orderId = $('#order_id').val();

            var status = $('#status').val();

            $('#update-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/update-order-status') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    orderId: orderId,
                    status: status,

                },
                success: function(response) {
                    $('#update-message').text('Update successful!');
                },
                error: function(xhr) {
                    $('#update-message').text('Error: ' + xhr.responseText);
                },
                complete: function() {
                    $('#assignOrder').modal('hide');
                    $('#update-message').text('');
                    $('.order_listing').DataTable().ajax.reload();
                }
            });
        });
    });
</script>

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
                        <h3 class="card-title text-white">Customers</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$customers}}</h2>
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
                        <div  class="col-sm-12" style="background:white;  display: flex;  flex-wrap: wrap; flex-direction: row; justify-content: space-between;">

                            {{-- <p style="margin-top: 14px;"><i class="fa fa-user"></i>  <button class="btn btn-sm  btn-info ml-2 my-3 add" type="button">Add customer credit card</button></p> --}}

                            <p></p>

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
                            <table class="table table-hover credit-listing table-listing table-hover " style=" width:100%;">
                                <thead>
                                    <tr>

                                        <th>Id</th>
                                        <th>Brand</th>
                                        <th>Date</th>
                                        <th>Pin</th>
                                        <th>Customer Name</th>
                                        <th>Refrence No.</th>
                                        <th>Gross Amount</th>
                                        <th>Fee</th>
                                        <th>Net</th>
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




          {{-- add credit card --}}
          <div class="modal fade" id="addCreditCard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Add credit card</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <form id="addCreditCardForm" enctype="multipart/form-data">
                            <div id="sending-message" class="text-danger fw-bold"></div>
                            <br>
                            <div class="row d-flex justify-content-center align-items-center bg-light">
                                <div class="form-group col-md-6">


                                    <label class="control-label">Brand</label>

                                    <select name="brand" id="brand" class="form-select" required>
                                        <option value="" selected disabled>Select Comapny</option>
                                        <option value="Phillips">Phillips</option>
                                        <option value="Valero">Valero </option>
                                        <option value="Global">Global</option>
                                        <option value="NGL Crude">NGL Crude</option>
                                        <option value="Motiva">Motiva</option>
                                        <option value="Shell">Shell</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">

                                    <label class="control-label">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" required>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Pin</label>
                                    <input type="password" name="pin" id="pin" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">Customer Id</label>

                                    <select name="customer_id" id="customer_id">
                                        @foreach($customerDetail as $customer)
                                            <option value="{{@$customer->id}}">{{@$customer->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Reference Card</label>
                                    <input type="text" name="reference_no" id="reference_no" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Gross Amount</label>
                                    <input type="text" name="gross_amount" id="gross_amount" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Fee</label>
                                    <input type="text" name="fee" id="fee" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Net</label>
                                    <input type="text" name="net" id="net" class="form-control" required>
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




        {{-- update credit brand --}}
        <div class="modal fade" id="editCreditCard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Credit Card</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <input type="hidden" name="update_customer_id" id="update_customer_id">
                        <div id="update-message" class="text-danger fw-bold"></div>
                        <div class="row d-flex justify-content-center align-items-center bg-light">

                            <div class="form-group col-md-6">


                                <label class="control-label">Brand</label>

                                <select name="update_brand" id="update_brand" class="form-select" required>
                                    <option value="" selected disabled>Select Comapny</option>
                                    <option value="Phillips">Phillips</option>
                                    <option value="Valero">Valero </option>
                                    <option value="Global">Global</option>
                                    <option value="NGL Crude">NGL Crude</option>
                                    <option value="Motiva">Motiva</option>
                                    <option value="Shell">Shell</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">

                                <label class="control-label">Date</label>
                                <input type="date" name="update_date" id="update_date" class="form-control" required>

                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Pin</label>
                                <input type="text" name="update_pin" id="update_pin" class="form-control" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Reference Card</label>
                                <input type="text" name="update_reference_no" id="update_reference_no" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Gross Amount</label>
                                <input type="text" name="update_gross_amount" id="update_gross_amount" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Fee</label>
                                <input type="text" name="update_fee" id="update_fee" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Net</label>
                                <input type="text" name="update_net" id="update_net" class="form-control" required>
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
            var table = $('.credit-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/credit-cards-list') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    }
                },

                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'brand',
                        name: 'brand'
                    },
                    {
                        data: 'card_date',
                        name: 'card_date'
                    },
                    {
                        data: 'card_pin',
                        name: 'card_pin'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'card_reference_no',
                        name: 'card_reference_no'
                    },
                    {
                        data: 'card_gross_amount',
                        name: 'card_gross_amount'
                    },
                    {
                        data: 'card_fee',
                        name: 'card_fee'
                    },
                    {
                        data: 'card_net',
                        name: 'card_net'
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
                $('.credit-listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script>




<script>
   $(document).ready(function() {
    $('.add').click(function() {
        $('#addCreditCard').modal('show');
    });

    $('#addCreditCardForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(form[0]);

        $('#sending-message').text('Processing request, please wait...');

        $.ajax({
            url: "{{ url('/add-credit-cards') }}",
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
                $('.credit-listing').DataTable().ajax.reload();
            },
            error: function(xhr) {
                $('#sending-message').text('Error occurred. Please try again.');
                console.log(xhr.responseText);
            },
            complete: function() {
                $('#addCreditCard').modal('hide');
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
            var customerId = $(this).val();

            $('#editCreditCard').modal('show');

            $.ajax({
                type: "GET",
                url: "edit-credit-cards/" + customerId,
                success: function(response) {
                    console.log(response);


                    $('#update_customer_id').val(customerId);
                    $('#update_brand').val(response.customer.brand);
                    $('#update_date').val(response.customer.card_date);
                    $('#update_pin').val(response.customer.card_pin);
                    $('#update_reference_no').val(response.customer.card_reference_no);
                    $('#update_gross_amount').val(response.customer.card_gross_amount);
                    $('#update_fee').val(response.customer.card_fee);
                    $('#update_net').val(response.customer.card_net);

                }
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#updateBtn').on('click', function () {
            var customerId = $('#update_customer_id').val();
            var brand = $('#update_brand').val();
            var date = $('#update_date').val();
            var pin = $('#update_pin').val();
            var reference_no = $('#update_reference_no').val();
            var gross_amount = $('#update_gross_amount').val();
            var fee = $('#update_fee').val();
            var net = $('#update_net').val();

            $('#update-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/update-credit-cards') }}",
                type: 'POST', // Correct HTTP method
                data: {
                    customer_id: customerId,
                    brand: brand,
                    card_date: date,
                    card_pin: pin,
                    card_reference_no: reference_no,
                    card_gross_amount: gross_amount,
                    card_fee: fee,
                    card_net: net
                },
                success: function (response) {
                    $('#editCreditCard').modal('hide');
                    $('.credit-listing').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    $('#update-message').text('Error: ' + xhr.responseText);
                },
                complete: function () {
                    $('#update-message').text('');
                }
            });
        });

    });
</script>


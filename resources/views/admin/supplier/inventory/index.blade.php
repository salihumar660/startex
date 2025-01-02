@include('admin.component.header')
{{-- @include('admin.component.style') --}}
@include('admin.component.topnav')
@include('admin.component.navbar')


<div class="content-body">
    <div class="container-fluid mt-3">


        <div class="row mt-4">
            <div class="col">
                <div class="card" style="overflow:auto; width:100% !important;">
                    <div class="card-header">
                        <div class="col-md-12"
                            style="background:white;  display: flex;  flex-wrap: wrap; flex-direction: row; justify-content: space-between; align-items:center;">

                        <p style="font-size:20px;">Refill Inventory</p>

                            <form id="filter-form"
                                style="display:flex; align-items:center;  flex-wrap: nowrap; justify-content: space-between; margin-bottom: 0px;">

                                <label for="from_date" class="me-2 h4"></label>
                                <input type="date" id="from_date"class="me-2 form-control" name="from_date"
                                    style="width:40%;">

                                <label for="to_date" class="me-2 h4">-</label>
                                <input type="date" id="to_date" class="me-2 form-control" name="to_date"
                                    style="width:40%;">

                                <button type="submit" class=" me-2 btn btn-primary" style="padding: 9px;"><i
                                        class="fas fa-check"></i></button>

                            </form>

                        </div>

                    </div>


                    <div class="card-body" v-cloak>

                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success</strong> &nbsp;

                                {{ session()->get('message') }}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif



                        <div class="table-responsive">
                            <table class="table table-hover inventory-listing table-listing table-hover "
                                style=" width:100%;">
                                <thead>
                                    <tr>


                                        <th>Id</th>
                                        <th>Branches</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Quantity (in gallon)</th>
                                        <th>Price (per gallon)</th>


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





        {{-- update Inventory --}}
        <div class="modal fade" id="editinventory" tabindex="-1" role="dialog"
            saria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">

                <div class="modal-content ">

                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-dark">

                        <input type="hidden" name="branch_id" id="branch_id">

                        <div id="update-message" class="text-danger fw-bold"></div>

                        <div class="row d-flex justify-content-center align-items-center">


                            <div class="form-group col-md-12">

                                <div class="form-group col-md-12">

                                    <input type="hidden" name="inventory_id" id="inventory_id"
                                        class="form-control">


                                    <label class="control-label">Quantity (in gallon)*</label>
                                    <input type="text" name="update_quantity" id="update_quantity"
                                        class="form-control">

                                    <label class="control-label">Price (per gallon) *</label>
                                    <input type="text" name="update_price" id="update_price"
                                        class="form-control">


                                </div>




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




{{-- data table  --}}
<script type="text/javascript">
    $(function() {
        setTimeout(function() {
            var table = $('.inventory-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/supplier-inventory-list') }}",
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
                        data: 'branch.name',
                        name: 'branch.name'
                    },
                    {
                        data: 'category.name',
                        name: 'category.name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },

                    {
                        data: 'created_by',
                        name: 'created_by'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ],
            });

            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                $('.inventory-listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script>



{{--  edit inventory --}}
<script>
    $(document).ready(function() {
        $(document).on('click', '.edit', function() {
            var inventoryId = $(this).val();

            $('#editinventory').modal('show');

            $.ajax({
                type: "GET",
                url: "edit-inventory-refill/" + inventoryId,
                success: function(response) {

                    $('#inventory_id').val(inventoryId);

                    $('#update_quantity').val(response.inventory.quantity);
                    $('#update_price').val(response.inventory.price);

                }
            });
        });
    });
</script>






{{-- update inventory --}}


<script>
    $(document).ready(function() {
        $('#updateBtn').on('click', function() {

            var inventoryId = $('#inventory_id').val();
            var update_quantity = $('#update_quantity').val();
            var update_price = $('#update_price').val();

            $('#update-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/supplier-refill-inventory') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token
                    inventoryId: inventoryId,

                    update_quantity: update_quantity,
                    update_price: update_price,

                },
                success: function(response) {
                    $('#update-message').text('Update successful!');
                },
                error: function(xhr) {
                    $('#update-message').text('Error: ' + xhr.responseText);
                },
                complete: function() {
                    $('#editinventory').modal('hide');
                    $('#update-message').text('');
                    $('.inventory-listing').DataTable().ajax.reload();
                }
            });
        });
    });
</script>

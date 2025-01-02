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
                        <h3 class="card-title text-white">Gas</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ @$inventory }}</h2>
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
                        <div class="col-md-12"
                            style="background:white;  display: flex;  flex-wrap: wrap; flex-direction: row; justify-content: space-between;">

                            <p style="margin-top: 14px;"><i class="fa fa-user"></i> <button
                                    class="btn btn-sm  btn-info ml-2 my-3 add" type="button">Add Gas</button></p>


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


                                        <th>id</th>
                                        <th>branches</th>
                                        <th>category</th>
                                        <th>name</th>
                                        <th>description</th>
                                        <th>quantity (in gallon)</th>
                                        <th>price (per gallon)</th>


                                        <th>created_at</th>
                                        <th>action</th>

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




        {{-- add inventory --}}
        <div class="modal fade" id="addinventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Add </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <form id="addinventoryForm" enctype="multipart/form-data">
                            <div id="sending-message" class="text-danger fw-bold"></div>
                            <br>
                            <div class="row d-flex justify-content-center align-items-center">
                                {{-- Add Inventory  --}}

                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="form-group col-md-12">

                                        <label class="control-label">Branch</label>
                                        <select name="branch_id" id="branch_id" class="form-select">
                                            <option selected disabled>Select Branch</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach

                                        </select>

                                        <label class="control-label">Category</label>
                                        <select name="category_id" id="category_id" class="form-select">
                                            <option selected disabled>Select Category</option>
                                            @foreach ($inventoryCategory as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach

                                        </select>

                                        <label class="control-label">Name</label>
                                        <input type="name" name="name" id="name" class="form-control"
                                            required>

                                        <label class="control-label">Description</label>
                                        <input type="text" name="description" id="description" class="form-control"
                                            required>

                                        <label class="control-label">Quantity (in gallon)</label>
                                        <input type="text" name="quantity" id="quantity" class="form-control"
                                            required>

                                        <label class="control-label">Price (per gallon)</label>
                                        <input type="text" name="price" id="price" class="form-control"
                                            required>

                                        {{-- <label class="control-label">Karat</label>
                                        <input type="text" name="karat" id="karat" class="form-control"
                                            required> --}}


                                    </div>
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




        {{-- update Inventory --}}
        <div class="modal fade" id="editinventory" tabindex="-1" role="dialog"
            saria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">

                <div class="modal-content ">

                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">edit</h5>
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

                                        <label class="control-label">branch</label>
                                        <select name="update_branch_id" id="update_branch_id" class="form-select">
                                            <option selected disabled>select_branch</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach

                                        </select>

                                        <label class="control-label">category</label>
                                        <select name="update_category_id" id="update_category_id" class="form-select">
                                            <option selected disabled>select_category</option>
                                            @foreach ($inventoryCategory as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach

                                        </select>

                                    <label class="control-label">name</label>
                                    <input type="text" name="update_name" id="update_name" class="form-control">

                                    <label class="control-label">description</label>
                                    <input type="text" name="update_description" id="update_description"
                                        class="form-control">

                                    <label class="control-label">quantity (in gallon)</label>
                                    <input type="text" name="update_quantity" id="update_quantity"
                                        class="form-control">

                                    <label class="control-label">price (per gallon)</label>
                                    <input type="text" name="update_price" id="update_price"
                                        class="form-control">


                                    {{-- <label class="control-label">karat</label>
                                    <input type="text" name="update_karat" id="update_karat"
                                        class="form-control"> --}}

                                </div>




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




{{-- data table  --}}
<script type="text/javascript">
    $(function() {
        setTimeout(function() {
            var table = $('.inventory-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/inventory-list') }}",
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
                    // {
                    //     data: 'karat',
                    //     name: 'karat'
                    // },
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



{{-- add data --}}
<script>
    $(document).ready(function() {
        $('.add').click(function() {
            $('#addinventory').modal('show');
        });

        $('#addinventoryForm').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = new FormData(form[0]);

            console.log(formData);

            $('#sending-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/add-inventory') }}",
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
                    $('.inventory-listing').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    $('#sending-message').text('Error occurred. Please try again.');
                    console.log(xhr.responseText);
                },
                complete: function() {
                    $('#addinventory').modal('hide');
                    $('#sending-message').text('');
                }
            });
        });
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
                url: "edit-inventory/" + inventoryId,
                success: function(response) {

                    $('#inventory_id').val(inventoryId);
                    $('#update_name').val(response.inventory.name);
                    $('#update_description').val(response.inventory.description);
                    $('#update_quantity').val(response.inventory.quantity);
                    $('#update_price').val(response.inventory.price);
                    // $('#update_karat').val(response.inventory.karat);
                    $('#update_branch_id').val(response.inventory.branch_id);
                    $('#update_category_id').val(response.inventory.category_id);
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
            var name = $('#update_name').val();
            var update_description = $('#update_description').val();
            var update_quantity = $('#update_quantity').val();
            var update_price = $('#update_price').val();
            // var update_karat = $('#update_karat').val();
            var update_branch_id = $('#update_branch_id').val();
            var update_category_id = $('#update_category_id').val();

            $('#update-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/update-inventory') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token
                    inventoryId: inventoryId,
                    name: name,
                    update_description: update_description,
                    update_quantity: update_quantity,
                    update_price: update_price,
                    // update_karat: update_karat,
                    update_branch_id: update_branch_id,
                    update_category_id: update_category_id,
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

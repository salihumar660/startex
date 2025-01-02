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
                        <h3 class="card-title text-white">{{ __('SE.inventory_category') }}</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ @$inventoryCategory }}</h2>
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
                                    class="btn btn-sm  btn-info ml-2 my-3 add" type="button">{{ __('SE.add') }}</button></p>


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
                                <strong>{{ __('SE.success') }}</strong> &nbsp;

                                {{ session()->get('message') }}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif



                        <div class="table-responsive">
                            <table class="table table-hover inventory-Category-listing table-listing table-hover "
                                style=" width:100%;">
                                <thead>
                                    <tr>

                                        <th>{{ __('SE.id') }}</th>
                                        <th>{{ __('SE.name') }}</th>
                                        <th>{{ __('SE.description') }}</th>
                                        <th>{{ __('SE.created_at') }}</th>
                                        <th>{{ __('SE.action') }}</th>

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
        <div class="modal fade" id="addinventoryCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">{{ __('SE.add') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <form id="addinventoryCategoryForm" enctype="multipart/form-data">
                            <div id="sending-message" class="text-danger fw-bold"></div>
                            <br>
                            <div class="row d-flex justify-content-center align-items-center">
                                {{-- Add Inventory  --}}

                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="form-group col-md-12">



                                        <label class="control-label">{{ __('SE.name') }}</label>
                                        <input type="name" name="name" id="name" class="form-control"
                                            required>

                                        <label class="control-label">{{ __('SE.description') }}</label>
                                        <input type="text" name="description" id="description" class="form-control"
                                            required>


                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">{{ __('SE.add') }}</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        {{-- update Inventory --}}
        <div class="modal fade" id="editinventoryCategory" tabindex="-1" role="dialog"
            saria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">

                <div class="modal-content ">

                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">{{ __('SE.edit') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-dark">


                        <div id="update-message" class="text-danger fw-bold"></div>

                        <div class="row d-flex justify-content-center align-items-center">


                            <div class="form-group col-md-12">

                                <div class="form-group col-md-12">

                                    <input type="hidden" name="inventoryCategory_id" id="inventoryCategory_id"
                                        class="form-control">


                                    <label class="control-label">{{ __('SE.name') }}</label>
                                    <input type="text" name="update_name" id="update_name" class="form-control">

                                    <label class="control-label">{{ __('SE.description') }}</label>
                                    <input type="text" name="update_description" id="update_description"
                                        class="form-control">

                                    </div>


                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-lg-right " id="updateBtn">{{ __('SE.submit') }}</button>

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
            var table = $('.inventory-Category-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/inventoryCategory-list') }}",
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
                        data: 'description',
                        name: 'description'
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
                $('.inventory-Category-listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script>



{{-- add data --}}
<script>
    $(document).ready(function() {
        $('.add').click(function() {
            $('#addinventoryCategory').modal('show');
        });

        $('#addinventoryCategoryForm').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = new FormData(form[0]);

            console.log(formData);

            $('#sending-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/add-inventoryCategory') }}",
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
                    $('.inventory-Category-listing').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    $('#sending-message').text('Error occurred. Please try again.');
                    console.log(xhr.responseText);
                },
                complete: function() {
                    $('#addinventoryCategory').modal('hide');
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
            var inventoryCategoryId = $(this).val();

            $('#editinventoryCategory').modal('show');

            $.ajax({
                type: "GET",
                url: "edit-inventoryCategory/" + inventoryCategoryId,
                success: function(response) {

                    $('#inventoryCategory_id').val(inventoryCategoryId);
                    $('#update_name').val(response.inventoryCategory.name);
                    $('#update_description').val(response.inventoryCategory.description);
                }
            });
        });
    });
</script>






{{-- update inventory --}}


<script>
    $(document).ready(function() {
        $('#updateBtn').on('click', function() {

            var inventoryCategoryId = $('#inventoryCategory_id').val();
            var name = $('#update_name').val();
            var update_description = $('#update_description').val();

            $('#update-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/update-inventoryCategory') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token
                    inventoryCategoryId: inventoryCategoryId,
                    name: name,
                    update_description: update_description,

                },
                success: function(response) {
                    $('#update-message').text('Update successful!');
                },
                error: function(xhr) {
                    $('#update-message').text('Error: ' + xhr.responseText);
                },
                complete: function() {
                    $('#editinventoryCategory').modal('hide');
                    $('#update-message').text('');
                    $('.inventory-Category-listing').DataTable().ajax.reload();
                }
            });
        });
    });
</script>

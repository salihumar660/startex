@include('admin.component.header')
{{-- @include('admin.component.style') --}}
@include('admin.component.topnav')
@include('admin.component.navbar')

<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row justify-content-center">
                        <div class="col-md-8 p-5">
                            <h4 class="text-center fw-bold">ORDER FORM</h4>
                            <form action="{{ url('/add-order') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="date" name="date" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Oil Type Section -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="type_of_oil">Select Oil Type and Gallon</label>
                                            <div id="oil-container">
                                                <div class="form-check">
                                                    <input type="checkbox" name="type_of_oil[]" value="89" class="form-check-input oil-checkbox" id="oil_89">
                                                    <label class="form-check-label" for="oil_89">89</label>
                                                    <input type="number" step="0.01" name="gallons[89]" placeholder="Gallon" class="form-control mt-2 gallon-input" >
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="type_of_oil[]" value="93" class="form-check-input oil-checkbox" id="oil_93">
                                                    <label class="form-check-label" for="oil_93">93</label>
                                                    <input type="number" step="0.01" name="gallons[93]" placeholder="Gallon" class="form-control mt-2 gallon-input" >
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="type_of_oil[]" value="TX Ultra Low Sulfur" class="form-check-input oil-checkbox" id="oil_tx">
                                                    <label class="form-check-label" for="oil_tx">TX Ultra Low Sulfur</label>
                                                    <input type="number" step="0.01" name="gallons[TX Ultra Low Sulfur]" placeholder="Gallon" class="form-control mt-2 gallon-input" >
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="type_of_oil[]" value="87" class="form-check-input oil-checkbox" id="oil_87">
                                                    <label class="form-check-label" for="oil_87">87</label>
                                                    <input type="number" step="0.01" name="gallons[87]" placeholder="Gallon" class="form-control mt-2 gallon-input" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

            <div class="row mt-4">
                <div class="col">
                    <div class="card" style="overflow:auto; width:100% !important;">
                        <h3 class="text-center m-2">Placed Order</h3>
                        <div class="card-header">
                            <div class="col-md-12"
                                style="background:white;  display: flex;  flex-wrap: wrap; flex-direction: row; justify-content: space-between;">

                                <p style="margin-top: 14px;"><i class="fa fa-cart"></i> </p>


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



                            <div class="table-responsive">
                                <table class="table table-hover order_listing table-listing table-hover "
                                    style=" width:100%;">
                                    <thead>
                                        <tr>

                                            <th>Id</th>
                                            <th>User Email</th>
                                            <th>Gallon</th>
                                            <th>Address</th>
                                            <th>Company</th>
                                            <th>Date</th>
                                            <th>Type of oil</th>
                                            <th>Status</th>
                                            <th>Invoice</th>
                                            <th>Created At</th>

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
                    url: "{{ url('/order-list') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();

                    }
                },

                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'user.email', name: 'user.email' },
                    { data: 'gallon', name: 'gallon' },
                    { data: 'address', name: 'address' },
                    { data: 'company', name: 'company' },
                    { data: 'date', name: 'date' },
                    { data: 'type_of_oil', name: 'type_of_oil' },
                    { data: 'status', name: 'status' },
                    { data: 'invoice', name: 'invoice' },
                    { data: 'created_at', name: 'created_at' },
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



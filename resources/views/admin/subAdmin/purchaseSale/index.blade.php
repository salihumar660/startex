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
                                <h3 class="text-center m-2">Purchase Sale</h3>
                                <div class="card-header">
                                    <div class="col-md-12"
                                        style="background:white;  display: flex;  flex-wrap: wrap; flex-direction: row; justify-content: space-between;">

                                      <p></p>

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
                                                    <th>Brand</th>
                                                    <th>Date</th>
                                                    <th>Bol#</th>
                                                    <th>Company</th>
                                                    <th>Driver</th>
                                                    <th>Gallon</th>
                                                    <th>Gross Amount</th>
                                                    <th>Charges</th>
                                                    <th>Net Amount</th>
                                                    <th>Receive</th>
                                                    <th>Rec Date</th>
                                                    <th>In days</th>
                                                    <th>Transport Charges</th>
                                                    <th>Purchase Amount</th>
                                                    <th>Difference</th>
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
                    url: "{{ url('/purchase-sale-list') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();

                    }
                },

                columns: [

                    {data: 'brand',name: 'brand'},
                    {data: 'date',name: 'date'},
                    {data: 'bol',name: 'bol'},

                    {
                        data: 'company',
                        name: 'company'
                    },
                    {data: 'driver',name: 'driver'},
                    {data: 'gallon',name: 'gallon'},
                    {data: 'gross_amt',name: 'gross_amt'},
                    {data: 'charges',name: 'charges'},
                    {data: 'net_amount',name: 'net_amount'},
                    {data: 'receive',name: 'receive'},
                    {data: 'rec_date',name: 'rec_date'},
                    {data: 'in_days',name: 'in_days'},
                    {data: 'transport_charges',name: 'transport_charges'},
                    {data: 'purchase_amount',name: 'purchase_amount'},
                    {data: 'difference',name: 'difference'},

                    {
                        data: 'created_at',
                        name: 'created_at'
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



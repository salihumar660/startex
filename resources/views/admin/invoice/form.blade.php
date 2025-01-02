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
                            <h4>Invoice Form</h4>


                            <!-- invoice Form -->
                            <form action="{{ url('/add-invoice') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="order_id" value="{{ @$id }}" class="form-control" required>

                                    <div class="form-group col-md-6">
                                        <label for="detail">Description</label>
                                        <input type="text" name="description"  class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="detail">Rack</label>
                                        <input type="text" value="{{ @$customer->credit_limit }}" name="rack" class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="detail">Tax</label>
                                        <input type="text" value="{{ @$customer->income }}" name="tax" class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="detail">Commission</label>
                                        <input type="text" value="{{ @$customer->commission }}" name="commission" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="detail">Price</label>
                                        <input type="text" value="{{ @$customer->set_price }}" name="price" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="detail">Card date</label>
                                        <input type="date" name="card_date"  value="{{ @$customer->credit_company }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="detail">Card ref</label>
                                        <input type="text" name="card_ref"  value="{{ @$customer->expiry_date }}"class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="detail">Card net</label>
                                        <input type="text" name="card_net" value="{{ @$customer->accept_split_order }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="detail">Charges transportation amount</label>
                                        <input type="text" value="{{ @$customer->set_price }}" name="charges_transportation_amount" class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="detail">Charges gilbarco amount</label>
                                        <input type="text" value="{{ @$customer->texas_trans_dieselRate }} "name="charges_gilbaro_amount" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="detail">Charges tx delivery fee</label>
                                        <input type="text" value="{{ @$customer->startex_gas_oil_fuelRate }} "  name="charges_tx_delivery_fee" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="detail">Charges cybera</label>
                                        <input type="text" name="charges_cybera" value="{{ @$customer->quiraga_dieselRate }} " class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="detail">Charges fed oil spil fee</label>
                                        <input type="text" value="{{ @$customer->quiraga_flatRate }} "  name="charges_fed_oil_spil_fee" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="detail">Charges transport surcharge</label>
                                        <input type="text"   value="{{ @$customer->coastal_transport_fuelRate }} "   name="charges_transport_surcharge" class="form-control" required>
                                    </div>

                                </div>


                                <div class="d-flex justify-content-center">

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-12">
                <div class="card">

            <div class="row mt-4">
                <div class="col">
                    <div class="card" style="overflow:auto; width:100% !important;">
                        <h3 class="text-center m-2">
                            Invoices

                        </h3>
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
                                <table class="table table-hover invoice_listing table-listing table-hover "
                                    style=" width:100%;">
                                    <thead>
                                        <tr>

                                            <th>Id</th>

                                            <th>Order ID</th>
                                            <th>Description</th>
                                            <th>Rack</th>
                                            <th>Tax</th>
                                            <th>Commision</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>Card Date</th>
                                            <th>Card Ref</th>
                                            <th>Card Net</th>
                                            <th>Charges transportation amount</th>
                                            <th>Charges gilbarco amount</th>
                                            <th>Charges tx delivery fee</th>
                                            <th>Charges cybera</th>
                                            <th>Charges fed oil spil fee</th>
                                            <th>Charges transport surcharge</th>
                                            <th>Gross amount</th>
                                            <th>Add charges</th>
                                            <th>Credit cards</th>
                                            <th>Net amount</th>
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

                </div>
            </div>
        </div> --}}
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
{{-- <script type="text/javascript">
    $(function() {
        setTimeout(function() {
            var table = $('.invoice_listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/invoice-list') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();

                    }
                },

                columns: [
                    {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'order_id',
                        name: 'order_id'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },

                    {
                        data: 'rack',
                        name: 'rack'
                    },
                    {
                        data: 'tax',
                        name: 'tax'
                    },
                    {
                        data: 'commission',
                        name: 'commission'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'card_date',
                        name: 'card_date'
                    },
                    {
                        data: 'card_ref',
                        name: 'card_ref'
                    },
                    {
                        data: 'card_net',
                        name: 'card_net'
                    },
                    {
                        data: 'charges_transportation_amount',
                        name: 'charges_transportation_amount'
                    },
                    {
                        data: 'charges_gilbarco_amount',
                        name: 'charges_gilbarco_amount'
                    },
                    {
                        data: 'charges_tx_delivery_fee',
                        name: 'charges_tx_delivery_fee'
                    },
                    {
                        data: 'charges_cybera',
                        name: 'charges_cybera'
                    },
                    {
                        data: 'charges_fed_oil_spil_fee',
                        name: 'charges_fed_oil_spil_fee'
                    },
                    {
                        data: 'charges_transport_surcharge',
                        name: 'charges_transport_surcharge'
                    },
                    {
                        data: 'gross_amount',
                        name: 'gross_amount'
                    },
                    {
                        data: 'add_charges',
                        name: 'add_charges'
                    },
                    {
                        data: 'credit_cards',
                        name: 'credit_cards'
                    },
                    {
                        data: 'net_amount',
                        name: 'net_amount'
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
                $('.invoice_listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script> --}}

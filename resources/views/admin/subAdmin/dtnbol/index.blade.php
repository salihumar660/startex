@include('admin.component.header')
{{-- @include('admin.component.style') --}}
@include('admin.component.topnav')
@include('admin.component.navbar')

<div class="content-body">
    <div class="container-fluid mt-3">

        <div class="row">
            <div class="col-12">

                <div class="row mt-4">
                    <div class="col">
                        <div class="card" style="overflow:auto; width:100% !important;">
                            <h3 class="text-center m-2"> DTN Bol </h3>


                            <div class="card-body" v-cloak>



                                <div class="table-responsive">
                                    <table class="table table-hover fuel_listing table-listing table-hover "
                                        style=" width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Bol number</th>
                                                <th>Terminal Control Number</th>
                                                <th>Terminal Name</th>
                                                <th>Fuel Product quantity</th>
                                                <th>Total Fuel Product quantity</th>
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
            var table = $('.fuel_listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/dtn-bol-list') }}",
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
                        data: 'bol_no',
                        name: 'bol_no'
                    },

                    {
                        data: 'terminal_control_number',
                        name: 'terminal_control_number'
                    },

                    {
                        data: 'terminal_name',
                        name: 'terminal_name'
                    },

                    {
                        data: 'fuel_product_qty',
                        name: 'fuel_product_qty'
                    },

                    {
                        data: 'total_fuel_product_qty',
                        name: 'total_fuel_product_qty'
                    },


                ],
                order: [
                    [0, 'desc']
                ],
            });

            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                $('.fuel_listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script>


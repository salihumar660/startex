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
                            <h3 class="text-center m-2"> GAS PRICE</h3>
                            <div class="card-header">
                                <div class="col-md-12"
                                    style="background:white;  display: flex;  flex-wrap: wrap; flex-direction: row; justify-content: space-between;">

                                    <p style="margin-top: 14px;"><i class="fa fa-cart"></i> </p>

                                    <form id="filter-form" style="display: flex; align-items: center; flex-wrap: nowrap; justify-content: space-between; margin-bottom: 0px;">
                                        <label for="company" class="me-2 ">Company</label>
                                        <select id="company" class="me-2 form-control" name="company" style="width: 30%;">
                                            <option value="">Select Company</option>
                                            <option value="Phillips">Phillips</option>
                                            <option value="Valero">Valero </option>
                                            <option value="Global">Global</option>
                                            <option value="NGL Crude">NGL Crude</option>
                                            <option value="Motiva">Motiva</option>
                                            <option value="Shell">Shell</option>
                                        </select>

                                        <label for="company"  class="me-2  ">Date</label>

                                        <input type="date" id="searchdate" class="form-control" name="searchdate" >

                                        <button type="submit" class="me-3 btn btn-primary" style="padding: 9px;"><i class="fas fa-check"></i></button>
                                    </form>


                                </div>

                            </div>


                            <div class="card-body" v-cloak>


                                <div class="table-responsive">
                                    <table class="table table-hover fuel_listing table-listing table-hover" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Detail</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Price</th>
                                                <th>Change</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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
                    url: "{{ url('/dtn-fuel-list') }}",
                    data: function(d) {
                        d.searchdate = $('#searchdate').val();
                        d.company = $('#company').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'remaining', name: 'remaining' },
                    { data: 'date', name: 'date' },
                    { data: 'time', name: 'time' },
                    { data: 'price', name: 'price' },
                    { data: 'change', name: 'change' },

                ],
                order: [[0, 'desc']],
            });

            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                table.ajax.reload();
            });
        }, 2000);
    });
</script>

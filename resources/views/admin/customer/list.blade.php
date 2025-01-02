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

                            {{-- <p style="margin-top: 14px;"><i class="fa fa-user"></i>  <button class="btn btn-sm  btn-info ml-2 my-3 add" type="button">add customer</button></p> --}}


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
                            <table class="table table-hover customer-listing table-listing table-hover " style=" width:100%;">
                                <thead>
                                    <tr>

                                        <th>CNO.</th>
                                        <th>Company</th>
                                        <th>Address</th>
                                        <th>City </th>
                                        <thState </th>
                                        <th>Zip </th>
                                        <th>Phone </th>
                                        <th>Fax </th>
                                        <th>Owner </th>
                                        <th>Zone </th>
                                        <th>Id </th>
                                        <th>Set price </th>
                                        <th>User pin </th>
                                        <th>PWD </th>
                                        <th>Active </th>
                                        <th>Accept_split_order </th>
                                        <th>Brn_name </th>
                                        <th>Brand_cusd_id </th>
                                        <th>Brn_active </th>

                                        <th>created_at</th>

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
            var table = $('.customer-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/customerList-list') }}",
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
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created',
                        name: 'created'
                    },

                ],
                order: [[0, 'desc']],
            });

            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                $('.customer-listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script>

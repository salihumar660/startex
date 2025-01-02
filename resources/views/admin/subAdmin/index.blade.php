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
                            <h4>{{ __('SE.sale_form') }}</h4>

                            <!-- Search Form -->
                            <form id="searchForm" class="mb-4">
                                <div class="input-group">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search for products...">
                                    <div class="input-group-append">
                                        <button type="button" id="searchButton" class="btn btn-primary">{{ __('SE.search') }}</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Inventory Form -->
                            <form action="{{ route('sales.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="buyer_name">{{ __('SE.buyer_name') }}</label>
                                    <input type="text" name="buyer_name" class="form-control" required>
                                </div>

                                @foreach ($inventories as $inventory)
                                <div class="form-group" id="product-{{ $inventory->id }}">
                                    <input type="checkbox" name="inventory_ids[]" value="{{ $inventory->id }}">
                                    <label>{{ $inventory->name }} - {{ $inventory->price }} </label>
                                    <input type="number" name="quantities[]" placeholder="{{ __('SE.quantity') }}" min="1" max="{{ $inventory->quantity }}" class="form-control">
                                    <input type="hidden" name="prices[]" value="{{ $inventory->price }}">
                                </div>
                                @endforeach

                                <div class="d-flex justify-content-center">

                                    <button type="submit" class="btn btn-primary">{{ __('SE.create_bill') }}</button>
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
                        <h3 class="text-center m-2">{{ __('SE.sold_items') }}</h3>
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
                                <table class="table table-hover sale-listing table-listing table-hover "
                                    style=" width:100%;">
                                    <thead>
                                        <tr>

                                            <th>{{ __('SE.id') }}</th>

                                            <th>{{ __('SE.category') }}</th>
                                            <th>{{ __('SE.name') }}</th>
                                            <th>{{ __('SE.description') }}</th>
                                            <th>{{ __('SE.quantity') }}</th>

                                            <th>{{ __('SE.created_at') }}</th>

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

<script>
    document.getElementById('searchButton').addEventListener('click', function() {
        const searchValue = document.getElementById('searchInput').value.toLowerCase();
        const productElements = document.querySelectorAll('[id^="product-"]');

        for (let productElement of productElements) {
            const label = productElement.querySelector('label').innerText.toLowerCase();
            if (label.includes(searchValue)) {
                productElement.scrollIntoView({ behavior: 'smooth' });
                break;
            }
        }
    });
</script>




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
            var table = $('.sale-listing').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/branch-sale-list') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        d.id = {{$user->branch_id}};

                    }
                },

                columns: [
                    {
                        data: 'inventory_id',
                        name: 'inventory_id'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
                    },
                    {
                        data: 'inventory_name',
                        name: 'inventory_name'
                    },
                    {
                        data: 'inventory_description',
                        name: 'inventory_description'
                    },
                    {
                        data: 'total_quantity_sold',
                        name: 'total_quantity_sold'
                    },


                    {
                        data: 'created_by',
                        name: 'created_by'
                    },

                ],
                order: [
                    [0, 'desc']
                ],
            });

            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                $('.sale-listing').DataTable().ajax.reload();
            });

        }, 2000);
    });
</script>

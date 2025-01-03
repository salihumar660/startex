@include('admin.component.header')
@include('admin.component.topnav')
@include('admin.component.navbar')



<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="container-fluid mt-3">

        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body" >
                        <h3 class="card-title text-white">{{ __('SE.users') }}</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$user}}</h2>
                           <a class="m-0 p-0" href="{{url('/user')}}"> <p class="text-white mb-0">{{ __('SE.users') }} <i class="fa-solid fa-arrow-right m-2"></i></p></a>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">{{ __('SE.branches') }}</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$branch}}</h2>
                            <a href="{{url('/branch')}}"><p class="text-white mb-0">{{ __('SE.branches') }} <i class="fa-solid fa-arrow-right m-2"></i></p></a>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa-solid fa-code-branch"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card gradient-3">
                    <div class="card-body">
                        <h3 class="card-title text-white">Daily Amount:</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">${{ number_format($dailyInvoiceAmount, 2) }}</h2>

                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa-solid fa-code-branch"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card gradient-4">
                    <div class="card-body">
                        <h3 class="card-title text-white">Monthly Amount:</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">${{ number_format($monthlyInvoiceAmount, 2) }}</h2>

                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa-solid fa-code-branch"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card gradient-6">
                    <div class="card-body">
                        <h3 class="card-title text-white">Yearly Amount:</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">${{ number_format($yearlyInvoiceAmount, 2) }}</h2>

                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa-solid fa-code-branch"></i></span>
                    </div>
                </div>
            </div>

        </div>

        <div class="row" >
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12 mx-auto">
                        <div class="card" >
                            <div class="row">


                                <div class="col-md-6">
                                    <div id="ordersByCompanyChart" style="height: 370px; width: 100%; margin:auto"></div>
                                </div>
                                <div class="col-md-6">
                                    <div id="invoicesByAmountChart" style="height: 370px; width: 100%; margin:auto"></div>
                                </div>


                            </div>

                        </div>
                        <div class="card">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="ordersPerDayChart" style="height: 370px; width: 100%; margin:auto"></div>
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

<script>
    window.onload = function() {
        var ordersPerDayChart = new CanvasJS.Chart("ordersPerDayChart", {
            animationEnabled: true,
            theme: "light4",
            title: {
                text: "Total Orders"
            },
            axisX: {
                title: "{{ __('SE.date') }}",
                valueFormatString: "YYYY-MM-DD",
            },
            axisY: {
                title: "Total Orders",
                includeZero: false
            },
            data: [{
                type: "line",
                xValueFormatString: "YYYY-MM-DD",
                yValueFormatString: "#,##0 sales",
                dataPoints: [
                    @foreach($orderPerDay as $data)
                        { x: new Date("{{ $data->date }}"), y: {{ $data->total_order }} },
                    @endforeach
                ]
            }]
        });

        var ordersByCompanyChart = new CanvasJS.Chart("ordersByCompanyChart", {
            animationEnabled: true,
            theme: "light3",
            title: {
                text: "Orders by Company"
            },
            data: [{
                type: "pie",
                yValueFormatString: "#,##0 orders",
                indexLabel: "{label} ({y})",
                dataPoints: [
                    @foreach($ordersByCompany as $data)
                        { label: "{{ $data->company_name }}", y: {{ $data->total_orders }} },
                    @endforeach
                ]
            }]
        });

        var invoicesByAmountChart = new CanvasJS.Chart("invoicesByAmountChart", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Invoices by Amount"
            },
            data: [{
                type: "doughnut",
                yValueFormatString: "$#,##0.00",
                indexLabel: "{label}: {y}",
                dataPoints: [
                    @foreach($invoicesByAmount as $data)
                        { label: "{{ $data->description }}", y: {{ $data->total_amount }} },
                    @endforeach
                ]
            }]
        });
        invoicesByAmountChart.render();
        ordersByCompanyChart.render();
        ordersPerDayChart.render();
    }
</script>

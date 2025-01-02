@include('admin.component.header')
@include('admin.component.topnav')
@include('admin.component.navbar')



<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body" ">

    <div class="container-fluid mt-3">

 <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body" >
                        <h3 class="card-title text-white">Pending Orders</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{@$pendingOrder}}</h2>

                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Delivered Orders</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{@$deliveredOrder}}</h2>

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
                                <div class="col-md-12">
                                    <div id="driverLoadChart" style="height: 370px; width: 100%; margin: auto;"></div>
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
        var drivers = @json($driverLoadPerDay);

        var driverData = {};

        drivers.forEach(function(record) {
            if (!driverData[record.driver_name]) {
                driverData[record.driver_name] = [];
            }
            driverData[record.driver_name].push({
                x: new Date(record.date),
                y: record.total_load
            });
        });

        var dataSeries = [];
        for (var driverName in driverData) {
            dataSeries.push({
                type: "line",
                showInLegend: true,
                name: driverName, // Use driver name here
                xValueFormatString: "YYYY-MM-DD",
                yValueFormatString: "#,##0 load",
                dataPoints: driverData[driverName]
            });
        }

        var chart = new CanvasJS.Chart("driverLoadChart", {
            animationEnabled: true,
            theme: "light4",
            title: {
                text: "Driver Load Pickup Per Day"
            },
            axisX: {
                title: "Date",
                valueFormatString: "YYYY-MM-DD",
            },
            axisY: {
                title: "Total Load",
                includeZero: true
            },
            legend: {
                cursor: "pointer",
                itemclick: function(e) {
                    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                        e.dataSeries.visible = false;
                    } else {
                        e.dataSeries.visible = true;
                    }
                    chart.render();
                }
            },
            data: dataSeries
        });

        chart.render();
    };
</script>




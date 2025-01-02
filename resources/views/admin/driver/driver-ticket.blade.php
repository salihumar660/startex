@include('admin.component.header')
{{-- @include('admin.component.style') --}}
@include('admin.component.topnav')
@include('admin.component.navbar')

<style>
    * {
        box-sizing: border-box;
    }

    .container-box {
        font-family: 'Courier New', Courier, monospace;
        font-size: 12px;
        max-width: 800px;
        margin: 20px auto;
        border: 1px solid black;
        padding: 20px;
        background: white;
    }

    .header-start,
    .footer-start {
        width: 100%;
        text-align: center;
    }

    .header-start img {
        width: 50px;
    }

    .header h1 {
        font-size: 18px;
        margin: 0;
    }

    .header p {
        margin: 0;
    }

    .section-title {
        font-weight: bold;
        text-decoration: underline;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid black;
    }

    .signature {
        height: 150px;
        border: 1px solid black;
    }
</style>


<div class="content-body">
    <div class="container-box ">
        <form action="{{ url('/submit') }}" method="POST" id="signatureForm" enctype="multipart/form-data">
            @csrf

            {{-- <input type="text" id="signatureInput" name="signature"> --}}
            <div class="header-start">
                <img alt="Company Logo" height="50"
                    src="https://storage.googleapis.com/a1aa/image/PPnaQUMeG82FIaB3wNiLm7pQrBK1OgSs2pwYxhfHY4GJSG1TA.jpg"
                    width="50" />
                <h1>
                    MAJOR PETROLEUM TRANSPORT, INC.
                </h1>
                <p>
                    12750 S. KIRKWOOD, SUITE 8, STAFFORD, TX 77477
                </p>
                <p>
                    PHONE: (281) 295-2810 FAX: (281) 295-2811
                </p>
                <h2>
                    Delivery Ticket
                </h2>
            </div>

            <br>
            <div class="row">
                <div class="col-6">
                    <p>
                        <strong>
                            CUSTOMER:
                        </strong>
                        <input class="form-control" name="customer" value="{{ $order->user->id }}" type="text" />
                    </p>
                    <p>
                        <strong>
                            ADDRESS:
                        </strong>
                        <input class="form-control" name="address" type="text" value="{{ $order->address }}" />
                    </p>
                    <p>
                        <strong>
                            CITY:
                        </strong>
                        <input class="form-control" name="city" type="text" />
                    </p>
                    <p>
                        <strong>
                            PHONE:
                        </strong>
                        <input class="form-control" name="phone" type="text" />
                    </p>
                    <p>
                        <strong>
                            LD. #:
                        </strong>
                        <input class="form-control" name="ld" type="text" />
                    </p>
                    <p>
                        <strong>
                            ZONE:
                        </strong>
                        <input class="form-control" name="zone" type="text" />
                    </p>
                </div>
                <div class="col-6">
                    <p>
                        <strong>
                            ORDER #:
                        </strong>
                        <input class="form-control" name="order_number" type="text" value="{{ $order->id }}" />
                    </p>
                    <p>
                        <strong>
                            DELIVERY DATE:
                        </strong>
                        <input class="form-control" name="delivery_date" type="date" value="{{ $order->date }}" />
                    </p>
                    <p>
                        <strong>
                            DELIVERY TIME:
                        </strong>
                        <input class="form-control" name="delivery_time" type="time" />
                    </p>
                    <p>
                        <strong>
                            BL #:
                        </strong>
                        <input class="form-control" name="bl_number" type="text" />
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p>
                        <strong>
                            Mileage Begin:
                        </strong>
                        <input class="form-control" name="mileage_begin" type="text" />
                    </p>
                    <p>
                        <strong>
                            Load Started:
                        </strong>
                        <input class="form-control" name="load_started" type="text" />
                    </p>
                    <p>
                        <strong>
                            Unloading Started:
                        </strong>
                        <input class="form-control" name="unloading_started" type="text" />
                    </p>
                    <p>
                        <strong>
                            Rack:
                        </strong>
                        <input class="form-control" name="rack" type="text" />
                    </p>
                </div>
                <div class="col-6">
                    <p>
                        <strong>
                            End:
                        </strong>
                        <input class="form-control" name="end" type="text" />
                    </p>
                    <p>
                        <strong>
                            Finished:
                        </strong>
                        <input class="form-control" name="finished" type="text" />
                    </p>
                    <p>
                        <strong>
                            Finished:
                        </strong>
                        <input class="form-control" name="finished_2" type="text" />
                    </p>
                    <p>
                        <strong>
                            Load Account:
                        </strong>
                        <input class="form-control" name="load_account" type="text" />
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p>
                        <strong>Gas Type:</strong>
                    </p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" id="gasTypeS" name="gas_type" type="radio" value="S" required>
                        <label class="form-check-label" for="gasTypeS">S</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" id="gasTypeR" name="gas_type" type="radio" value="R" required>
                        <label class="form-check-label" for="gasTypeR">R</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <p>
                        <strong>
                            Consigned To:
                        </strong>
                        <input class="form-control" name="consigned_to" type="text" />
                    </p>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Ordered
                        </th>
                        <th>
                            Gross
                        </th>
                        <th>
                            Net
                        </th>
                        <th>
                            Before
                        </th>
                        <th>
                            After
                        </th>
                        <th>
                            Water
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="ordered_1" id="ordered_1" class="form-control">
                                <option value="R" selected>R</option>
                                <option value="S">S</option>
                            </select>
                            {{-- <input class="form-control" name="ordered_1" type="text" /> --}}
                        </td>
                        <td>
                            <input class="form-control" name="gross_1" type="text" />
                        </td>
                        <td>
                            <input class="form-control" name="net_1" type="text" />
                        </td>
                        <td>
                            <input class="form-control" name="before_1" type="text" />
                        </td>
                        <td>
                            <input class="form-control" name="after_1" type="text" />
                        </td>
                        <td>
                            <input class="form-control" name="water_1" type="text" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="ordered_2" id="ordered_2" class="form-control">
                                <option value="R" selected>R</option>
                                <option value="S">S</option>
                            </select>
                            {{-- <input class="form-control" name="ordered_2" type="text" /> --}}
                        </td>
                        <td>
                            <input class="form-control" name="gross_2" type="text" />
                        </td>
                        <td>
                            <input class="form-control" name="net_2" type="text" />
                        </td>
                        <td>
                            <input class="form-control" name="before_2" type="text" />
                        </td>
                        <td>
                            <input class="form-control" name="after_2" type="text" />
                        </td>
                        <td>
                            <input class="form-control" name="water_2" type="text" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-12">
                    <p>
                        <strong>
                            Extra Tank Reading:
                        </strong>
                        <input class="form-control" name="extra_tank_reading" type="text" />
                    </p>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Station Selling Fuel
                        </th>
                        <td>
                            <input class="form-check-input" name="station_fuel_required" type="radio"
                                value="yes" />
                        </td>
                        <td>
                            <input class="form-check-input" name="station_fuel_required" type="radio"
                                value="no" />
                        </td>
                        <td>
                            <input class="form-control" name="station_fuel_1" type="text" />
                        </td>
                        <td>
                            <input class="form-control" name="station_fuel_2" type="text" />
                        </td>
                        <td>
                            <input class="form-control" name="station_fuel_3" type="text" />
                        </td>
                        <td>
                            <input class="form-control" name="station_fuel_4" type="text" />
                        </td>
                        <td>
                            <input class="form-control" name="station_fuel_5" type="text" />
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Truck Pump was required
                        </td>
                        <td>

                            <input class="form-check-input" name="truck_pump_required" type="radio"
                                value="yes" />
                        </td>
                        <td>
                            <input class="form-check-input" name="truck_pump_required" type="radio"
                                value="no" />
                        </td>
                        <td>
                            <select name="truck_pump_1" id="truck_pump_1" class="form-control">
                                <option value="R" selected>R</option>
                                <option value="S">S</option>
                            </select>
                            {{-- <input class="form-control" name="truck_pump_1" type="text" /> --}}
                        </td>
                        <td>
                            <select name="truck_pump_2" id="truck_pump_2" class="form-control">
                                <option value="R" selected>R</option>
                                <option value="S">S</option>
                            </select>
                            {{-- <input class="form-control" name="truck_pump_2" type="text" /> --}}
                        </td>
                        <td>
                            <select name="truck_pump_3" id="truck_pump_3" class="form-control">
                                <option value="R" selected>R</option>
                                <option value="S">S</option>
                            </select>
                            {{-- <input class="form-control" name="truck_pump_3" type="text" /> --}}
                        </td>
                        <td>
                            <select name="truck_pump_4" id="truck_pump_4" class="form-control">
                                <option value="R" selected>R</option>
                                <option value="S">S</option>
                            </select>
                            {{-- <input class="form-control" name="truck_pump_4" type="text" /> --}}
                        </td>
                        <td>
                            <select name="truck_pump_5" id="truck_pump_5" class="form-control">
                                <option value="R" selected>R</option>
                                <option value="S">S</option>
                            </select>
                            {{-- <input class="form-control" name="truck_pump_5" type="text" /> --}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-6">
                    <p>
                        <strong>
                            Received in good order:
                        </strong>
                        <input class="form-control" name="received_in_good_order" type="text" />
                    </p>
                    <p>
                        <strong>
                            Date:
                        </strong>
                        <input class="form-control" name="date" type="date" />
                    </p>
                    <p>
                        <strong>
                            Driver:
                        </strong>
                        <input class="form-control" name="driver" type="text" value="{{ $user->name }}" />
                    </p>
                </div>
                <div class="col-6">
                    <p>
                        <strong>
                            Received Check:
                        </strong>
                        <input class="form-control" name="received_check" type="text" />
                    </p>
                    <p>
                        <strong>
                            Dated:
                        </strong>
                        <input class="form-control" name="dated" type="date" />
                    </p>
                    <p>
                        <strong>
                            Amount:
                        </strong>
                        <input class="form-control" name="amount" type="text" />
                    </p>
                    <p>
                        <strong>
                            COD Check #:
                        </strong>
                        <input class="form-control" name="cod_check" type="text" />
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <p><strong>Signature:</strong></p>
                    <canvas id="signatureCanvas" width="400" height="200"
                        style="border:1px solid #000;"></canvas>
                    <button class="btn btn-secondary" id="clearCanvasBtn" type="button">Clear</button>
                    <input id="signatureInput" name="signature" type="hidden" />

                </div>
            </div>
            <div class="footer-start">
                <p>
                    **** EMERGENCY CONTACT: (281) 295-2810 ****
                </p>
                <p>
                    This Facility is in compliance with all federal and state environmental laws.
                </p>
                <p>
                    WHITE COPY - OFFICE | YELLOW COPY - CUSTOMER | PINK COPY - DRIVER
                </p>
            </div>
            <div class="text-center">
                <button class="btn btn-primary" id="submitBtn" type="button">Submit</button>
            </div>

        </form>
    </div>
</div>


@include('admin.component.footer')



<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

<script>
   $(document).ready(function() {
    let canvas = document.getElementById("signatureCanvas");
    let ctx = canvas.getContext("2d");
    let drawing = false;

    canvas.addEventListener("mousedown", startDrawing);
    canvas.addEventListener("mouseup", stopDrawing);
    canvas.addEventListener("mousemove", draw);

    function startDrawing(e) {
        drawing = true;
        ctx.beginPath();
        ctx.moveTo(e.offsetX, e.offsetY);
    }

    function stopDrawing() {
        drawing = false;
    }

    function draw(e) {
        if (!drawing) return;
        ctx.lineWidth = 2;
        ctx.lineCap = "round";
        ctx.strokeStyle = "black";
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.stroke();
    }

    $('#clearCanvasBtn').on('click', function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    });
    $('#submitBtn').on('click', function() {
        saveSignature();

        var formData = new FormData($('#signatureForm')[0]);

        $.ajax({
            url: "{{ url('/submit') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert('Form submitted successfully!');
                console.log(response);
                window.location.reload();
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });

    function saveSignature() {
        var signatureDataUrl = canvas.toDataURL("image/png");
        $('#signatureInput').val(signatureDataUrl);
    }
});
</script>

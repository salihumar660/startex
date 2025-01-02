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
    <div class="container-box">
        <form action="{{ url('/submit') }}" method="POST" id="signatureForm" enctype="multipart/form-data">
            @csrf

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
                        <input class="form-control" name="customer" type="text" value="{{ @$formData->customer }}" disabled />
                    </p>
                    <p>
                        <strong>
                            ADDRESS:
                        </strong>
                        <input class="form-control" name="address" type="text" value="{{ @$formData->address }}" disabled />
                    </p>
                    <p>
                        <strong>
                            CITY:
                        </strong>
                        <input class="form-control" name="city" type="text" value="{{ @$formData->city }}" disabled />
                    </p>
                    <p>
                        <strong>
                            PHONE:
                        </strong>
                        <input class="form-control" name="phone" type="text" value="{{ @$formData->phone }}" disabled />
                    </p>
                    <p>
                        <strong>
                            LD. #:
                        </strong>
                        <input class="form-control" name="ld" type="text" value="{{ @$formData->ld }}" disabled />
                    </p>
                    <p>
                        <strong>
                            ZONE:
                        </strong>
                        <input class="form-control" name="zone" type="text" value="{{ @$formData->zone }}" disabled />
                    </p>
                </div>
                <div class="col-6">
                    <p>
                        <strong>
                            ORDER #:
                        </strong>
                        <input class="form-control" name="order_number" type="text" value="{{ @$formData->order_number }}" disabled />
                    </p>
                    <p>
                        <strong>
                            DELIVERY DATE:
                        </strong>
                        <input class="form-control" name="delivery_date" type="date" value="{{ @$formData->delivery_date }}" disabled />
                    </p>
                    <p>
                        <strong>
                            DELIVERY TIME:
                        </strong>
                        <input class="form-control" name="delivery_time" type="time" value="{{ @$formData->delivery_time }}" disabled />
                    </p>
                    <p>
                        <strong>
                            BL #:
                        </strong>
                        <input class="form-control" name="bl_number" type="text" value="{{ @$formData->bl_number }}" disabled />
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p>
                        <strong>
                            Mileage Begin:
                        </strong>
                        <input class="form-control" name="mileage_begin" type="text" value="{{ @$formData->mileage_begin }}" disabled />
                    </p>
                    <p>
                        <strong>
                            Load Started:
                        </strong>
                        <input class="form-control" name="load_started" type="text" value="{{ @$formData->load_started }}" disabled />
                    </p>
                    <p>
                        <strong>
                            Unloading Started:
                        </strong>
                        <input class="form-control" name="unloading_started" type="text" value="{{ @$formData->unloading_started }}" disabled />
                    </p>
                    <p>
                        <strong>
                            Rack:
                        </strong>
                        <input class="form-control" name="rack" type="text" value="{{ @$formData->rack }}" disabled />
                    </p>
                </div>
                <div class="col-6">
                    <p>
                        <strong>
                            End:
                        </strong>
                        <input class="form-control" name="end" type="text" value="{{ @$formData->end }}" disabled />
                    </p>
                    <p>
                        <strong>
                            Finished:
                        </strong>
                        <input class="form-control" name="finished" type="text" value="{{ @$formData->finished }}" disabled />
                    </p>
                    <p>
                        <strong>
                            Finished 2:
                        </strong>
                        <input class="form-control" name="finished_2" type="text" value="{{ @$formData->finished_2 }}" disabled />
                    </p>
                    <p>
                        <strong>
                            Load Account:
                        </strong>
                        <input class="form-control" name="load_account" type="text" value="{{ @$formData->load_account }}" disabled />
                    </p>
                </div>
            </div>
             <div class="row">
                <div class="col-12">
                    <p><strong>Gas Type:</strong></p>
                    {{$formData->gas_type}}
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            id="gasTypeS"
                            name="gas_type"
                            type="radio"
                            value="S"
                            {{ @$formData->gas_type == 'S' ? 'checked' : '' }}
                            disabled>
                        <label class="form-check-label" for="gasTypeS">S</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            id="gasTypeR"
                            name="gas_type"
                            type="radio"
                            value="R"
                            {{ @$formData->gas_type == 'R' ? 'checked' : '' }}
                            disabled>
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
                        <input class="form-control" name="consigned_to" type="text" value="{{ @$formData->consigned_to }}" disabled />
                    </p>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ordered</th>
                        <th>Gross</th>
                        <th>Net</th>
                        <th>Before</th>
                        <th>After</th>
                        <th>Water</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input class="form-control" name="ordered_1" type="text" value="{{ @$formData->ordered_1 }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="gross_1" type="text" value="{{ @$formData->gross_1 }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="net_1" type="text" value="{{ @$formData->net_1 }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="before_1" type="text" value="{{ @$formData->before_1 }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="after_1" type="text" value="{{ @$formData->after_1 }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="water_1" type="text" value="{{ @$formData->water_1 }}" disabled />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="form-control" name="ordered_2" type="text" value="{{ @$formData->ordered_2 }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="gross_2" type="text" value="{{ @$formData->gross_2 }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="net_2" type="text" value="{{ @$formData->net_2 }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="before_2" type="text" value="{{ @$formData->before_2 }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="after_2" type="text" value="{{ @$formData->after_2 }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="water_2" type="text" value="{{ @$formData->water_2 }}" disabled />
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
                        <input class="form-control" name="extra_tank_reading" type="text" value="{{ @$formData->extra_tank_reading }}" disabled />
                    </p>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Station Selling Fuel</th>
                        <td>
                            <input class="form-check-input" name="station_fuel_required" type="radio" value="yes" {{ @$formData->station_fuel_required == 'yes' ? 'checked' : '' }} disabled />
                        </td>
                        <td>
                            <input class="form-check-input" name="station_fuel_required" type="radio" value="no" {{ @$formData->station_fuel_required == 'no' ? 'checked' : '' }} disabled />
                        </td>
                        <td>
                            <input class="form-control" name="station_fuel_1" type="text" value="{{ @$formData->station_fuel['station_fuel_1'] }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="station_fuel_2" type="text" value="{{ @$formData->station_fuel['station_fuel_2'] }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="station_fuel_3" type="text" value="{{ @$formData->station_fuel['station_fuel_3'] }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="station_fuel_4" type="text" value="{{ @$formData->station_fuel['station_fuel_4'] }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="station_fuel_5" type="text" value="{{ @$formData->station_fuel['station_fuel_5'] }}" disabled />
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Truck Pump was required</td>
                        <td>
                            <input class="form-check-input" name="truck_pump_required" type="radio" value="yes" {{ @$formData->truck_pump_required == 'yes' ? 'checked' : '' }} disabled />
                        </td>
                        <td>
                            <input class="form-check-input" name="truck_pump_required" type="radio" value="no" {{ @$formData->truck_pump_required == 'no' ? 'checked' : '' }} disabled />
                        </td>
                        <td>
                            <input class="form-control" name="truck_pump_1" type="text" value="{{ @$formData->truck_pump['truck_pump_1'] }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="truck_pump_2" type="text" value="{{ @$formData->truck_pump['truck_pump_2'] }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="truck_pump_3" type="text" value="{{ @$formData->truck_pump['truck_pump_3'] }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="truck_pump_4" type="text" value="{{ @$formData->truck_pump['truck_pump_4'] }}" disabled />
                        </td>
                        <td>
                            <input class="form-control" name="truck_pump_5" type="text" value="{{ @$formData->truck_pump['truck_pump_5'] }}" disabled />
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
                        <input class="form-control" name="received_in_good_order" type="text" value="{{ @$formData->received_in_good_order }}" disabled />
                    </p>
                    <p>
                        <strong>
                            Date:
                        </strong>
                        <input class="form-control" name="date" type="date" value="{{ @$formData->date }}" disabled />
                    </p>
                    <p>
                        <strong>
                            Driver:
                        </strong>
                        <input class="form-control" name="driver" type="text" value="{{ @$formData->driver }}" disabled />
                    </p>
                </div>
                <div class="col-6">
                    <p>
                        <strong>
                            Received Check:
                        </strong>
                        <input class="form-control" name="received_check" type="text" value="{{ @$formData->received_check }}" disabled />
                    </p>
                    <p>
                        <strong>
                            Dated:
                        </strong>
                        <input class="form-control" name="dated" type="date" value="{{ @$formData->dated }}" disabled />
                    </p>
                    <p>
                        <strong>
                            Amount:
                        </strong>
                        <input class="form-control" name="amount" type="text" value="{{ @$formData->amount }}" disabled />
                    </p>
                    <p>
                        <strong>
                            COD Check #:
                        </strong>
                        <input class="form-control" name="cod_check" type="text" value="{{ @$formData->cod_check }}" disabled />
                    </p>
                </div>
            </div>
            {{-- ```php --}}
            <div class="row">
                <div class="col-12">
                    <p><strong>Signature:</strong></p>
                    {{-- <canvas id="signatureCanvas" width="400" height="200" style="border:1px solid #000;"></canvas>
                    <button class="btn btn-secondary" id="clearCanvasBtn" type="button" disabled>Clear</button>
                    <input id="signatureInput" name="signature" type="hidden" /> --}}
                    <img src="{{ asset($formData->signature) }}" width="400" height="200" style="border:1px solid #000;" alt="">


                </div>
            </div>
            <div class="footer-start">
                <p>**** EMERGENCY CONTACT: (281) 295-2810 ****</p>
                <p>This Facility is in compliance with all federal and state environmental laws.</p>
                <p>WHITE COPY - OFFICE | YELLOW COPY - CUSTOMER | PINK COPY - DRIVER</p>
            </div>
            {{-- <div class="text-center">
                <button class="btn btn-primary" id="submitBtn" type="button" disabled>Submit</button>
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


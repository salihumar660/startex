@include('admin.component.header')
{{-- @include('admin.component.style') --}}
@include('admin.component.topnav')
@include('admin.component.navbar')

<style>
    td,th{
        text-align: center !important;
    }
</style>

<div class="content-body">
    <div class="container-fluid mt-3">

        <div class="row">
            <div class="col-12">

                    @if ($assign->isEmpty())
                        <div class="card">

                            <h2 class="text-center">No order assign to you</h2>
                        </div>
                    @else
                        @foreach ($assign as $assignOrder)
                            <div class="card">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>

                                            <th colspan="6" class="text-center text-uppercase text-warning">

                                                @if (@$assignOrder->order->company == 'Shell')

                                                    <img src="{{ asset('images/logo/shellLogo.png') }}" alt="" width="150px">

                                                @elseif (@$assignOrder->order->company == 'Valero')

                                                    <img src="{{ asset('images/logo/valero.png') }}" alt="" width="150px">
                                                @elseif (@$assignOrder->order->company == 'NGL Crude')

                                                    <img src="{{ asset('images/logo/NGL Crude.png') }}" alt="" width="150px">
                                                @elseif (@$assignOrder->order->company == 'Phillips')

                                                    <img src="{{ asset('images/logo/Phillips.png') }}" alt="" width="150px">
                                                @elseif (@$assignOrder->order->company == 'Motiva')

                                                    <img src="{{ asset('images/logo/Motiva.png') }}" alt="" width="150px">
                                                @elseif (@$assignOrder->order->company == 'Global')

                                                    <img src="{{ asset('images/logo/Global.png') }}" alt="" width="150px">

                                                @endif

                                                <br>

                                                <span class="text-danger">{{ @$assignOrder->order->company }}</span>
                                                <br>
                                                Order Detail # <span class="text-dark">
                                                    {{ @$assignOrder->order->id }}
                                                </span>

                                                <br>
                                                Delivery Status # <span class="text-dark">
                                                    {{ @$assignOrder->order->status }}
                                                </span>

                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>


                                            <th>Gallon</th>
                                            <td>{{ @$assignOrder->order->gallon }}</td>
                                            <th>Address</th>
                                            <td>{{ @$assignOrder->order->address }}</td>



                                        </tr>
                                        <tr>

                                            <th>Date</th>
                                            <td>{{ @$assignOrder->order->date }}</td>
                                            <th>Type Of Oil</th>
                                            <td>{{ @$assignOrder->order->type_of_oil }}</td>
                                        </tr>

                                        <tr >
                                            <td colspan="3">
                                                <button class="btn btn-danger edit"
                                                    value="{{ @$assignOrder->order->id }}">Complete Delivery</button>
                                            </td>
                                            <td  colspan="3">


                                                <a href="{{ '/driver-ticket/'.@$assignOrder->order->id }}" class="btn btn-info ">Delivery Ticket</a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @endif



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






{{--  Edit Status --}}
<script>
    $(document).ready(function() {
        $(document).on('click', '.edit', function() {
            var orderId = $(this).val();


            $('#updateStatus').modal('show');

            $.ajax({
                type: "GET",
                url: "edit-driver-order/" + orderId,
                success: function(response) {
                    console.log(response);

                    $('#order_id').val(orderId);
                    $('#status').val(response.order.status);
                    $('#signatureCanvasImage').attr("src", response.order.signature_path);

                }
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        $(document).on('click', '.edit', function() {
            var orderId = $(this).val();

            // Show a confirmation dialog
            var userConfirmed = confirm(
                "Are you sure you want to complete the delivery and update the order status?");

            if (userConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "edit-driver-order/" + orderId,
                    success: function(response) {

                        if (response.status === 'success') {
                            alert('Order status updated to Complete.');

                            location.reload();
                        } else {
                            alert('Failed to update the order status.');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        alert('An error occurred while updating the order status.');
                    }
                });
            } else {
                console.log('User canceled the action.');
            }
        });
    });
</script>



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

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        // Clear canvas button event
        $('#clearCanvasBtn').on('click', function() {
            clearCanvas();
        });

        $('#updateBtn').on('click', function() {
            var orderId = $('#order_id').val();
            var status = $('#status').val();
            var signatureDataUrl = canvas.toDataURL("image/png");

            console.log(orderId);
            $('#update-message').text('Processing request, please wait...');

            $.ajax({
                url: "{{ url('/update-driver-order') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    orderId: orderId,
                    status: status,
                    signature: signatureDataUrl,
                },
                success: function(response) {
                    $('#update-message').text('Update successful!');
                },
                error: function(xhr) {
                    $('#update-message').text('Error: ' + xhr.responseText);
                },
                complete: function() {
                    $('#updateStatus').modal('hide');
                    $('#update-message').text('');
                    $('.order_listing').DataTable().ajax.reload();
                }
            });
        });
    });
</script>

@include('admin.component.header')
{{-- @include('admin.component.style') --}}
@include('admin.component.topnav')
@include('admin.component.navbar')


<style>
    .welcome-text{
        text-shadow: 2px 2px 3px rgba(0,0,0,0.71);
        text-transform:uppercase;
        letter-spacing:2px;
    }

    .userBtn{
        background: #2078af;
        background-image: -webkit-linear-gradient(top, #2078af, #0a4465);
        background-image: -moz-linear-gradient(top, #2078af, #0a4465);
        background-image: -ms-linear-gradient(top, #2078af, #0a4465);
        background-image: -o-linear-gradient(top, #2078af, #0a4465);
        background-image: linear-gradient(to bottom, #2078af, #0a4465);
        color:white;
        padding:40px !important;
        border-radius:30% !important;
        letter-spacing:1.5px;
        text-transform:uppercase;
        width:240px;
        height:200px;
        font-weight: 600 !important;
        transition: .2s ease-in-out;
        border:4px solid rgb(19, 115, 135) !important;
    }

    .userBtn:active{

        scale: .95;
        letter-spacing: 2px;
        font-size: 20px;
        font-style: italic;
        border-radius:50% !important;

    }
    .userBtn:hover{
        background: #013c61;
        background-image: -webkit-linear-gradient(top, #013c61, #3680b1);
        background-image: -moz-linear-gradient(top, #013c61, #3680b1);
        background-image: -ms-linear-gradient(top, #013c61, #3680b1);
        background-image: -o-linear-gradient(top, #013c61, #3680b1);
        background-image: linear-gradient(to bottom, #013c61, #3680b1);
        border:4px solid rgb(70, 132, 165) !important;
    }

</style>

<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row justify-content-center">
                        <div class="col-md-8 p-5">
                            <div class="container hide employee-container">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class=" text-center welcome-text">{{ __('SE.welcome') }} {{$user->name}}</h1>
                                    </div>


                                    @if (@$startData == null)
                                        <div class="col-12 text-center" >
                                            <input type="button" class="btn  start-btn userBtn" value="Start">
                                        </div>
                                    @else
                                        <div class="col-12 text-center">
                                            <input type="button" disabled class="btn  start-btn userBtn" style="color:red" value="Started">
                                        </div>
                                    @endif

                                </div>

                                <div class="row w-100 d-flex justify-content-between text-center">


                                    @if (@$endData == null && @$startData != null && @$Break->status != 'Break')
                                        {{-- <div class="col-3" style="border:2px solid black"> --}}
                                            <input type="button" class="btn  end-btn text-center userBtn" value="End for today">
                                        {{-- </div> --}}
                                    @elseif(@$endData != null && @$startData != null )
                                        {{-- <div class="col-3" style="border:2px solid black"> --}}
                                            <input type="button" disabled class="btn  text-center end-btn userBtn" style="color:red" value="Today job done">
                                        {{-- </div> --}}
                                    @endif



                                    @if(@$Break->status == 'Start' &&  @$endData == null)

                                        {{-- <div class="col-3 " style="border:2px solid black"> --}}
                                            <input type="button" class="btn  break-btn userBtn" value="Break">
                                        {{-- </div> --}}
                                    @elseif(@$Break->status == 'Break' &&  @$endData == null)

                                        {{-- <div class="col-3 " style="border:2px solid black"> --}}
                                            <input type="button" class="btn  break-btn userBtn " value="Break end">
                                        {{-- </div> --}}
                                    @elseif( @$Break->status == 'Break end'  &&  @$endData == null)

                                        {{-- <div class="col-3 " style="border:2px solid black"> --}}
                                            <input type="button" class="btn  break-btn userBtn " value="Break">
                                        {{-- </div> --}}
                                    @elseif(@$endData != null)
                                        {{-- <div class="col-3 " style="border:2px solid black"> --}}
                                            <input type="button" disabled class="btn  break-btn userBtn " value="Today job done " style="color:red" >
                                        {{-- </div> --}}

                                     @endif
                                </div>

                                <div class="row mt-1">
                                    <h3 class="text-center">{{ __('SE.last_seven_day_activity') }}</h3>
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">{{ __('SE.date') }}</th>
                                                <th scope="col">{{ __('SE.starting_time') }}</th>
                                                <th scope="col">{{ __('SE.end_time') }}</th>
                                                <th scope="col">{{ __('SE.total_break_time') }}</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $item)
                                                <tr>
                                                    <td>{{ $item['startTime']->format('d-m-Y') }}</td>
                                                    <td>{{ $item['startTime']->format(' H:i:s') }}</td>
                                                    <td>{{ $item['endTime'] ? $item['endTime']->format(' H:i:s') : '' }}</td>
                                                    <td>{{ $item['totalBreakTime'] }} minutes</td>
                                                </tr>
                                            @endforeach
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

@include('admin.component.footer')



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>


<script>


setTimeout(function() {
   function handleGeolocation(position) {
       const latitude = position.coords.latitude;
       const longitude = position.coords.longitude;

       console.log('Ready');


       if (latitude != null && longitude != null) {

           const employeeContainer = $('.employee-container');
           employeeContainer.addClass('show').removeClass('hide');


           $('.userBtn').click(function() {
               const btnValue = $(this).val();
               console.log(btnValue);

               $.ajax({
                   url: '/user-dashboard-data',
                   method: 'GET',
                   data: {
                       lat: latitude,
                       lng: longitude,
                       buttonvalue: btnValue
                   },
                   success: function(response) {

                       // console.log(response.message);

                       if (response.message == 'Start') {
                           const startBtn = $('.start-btn');
                           startBtn.prop('disabled', true);
                           startBtn.css('color', 'red');
                           startBtn.val('Started');
                       } else if (response.message == 'End for today') {
                           const EndBtn = $('.end-btn');
                           const breakBtn = $('.break-btn');
                           EndBtn.prop('disabled', true);
                           EndBtn.css('color', 'red');
                           EndBtn.val('Today job done');
                           breakBtn.prop('disabled', true);
                           breakBtn.css('color', 'red');
                           breakBtn.val('Today job done');
                       } else if (response.message == 'Break') {
                           const breakBtn = $('.break-btn');
                           breakBtn.val('Break end');
                       } else if (response.message == 'Break end') {
                           const breakBtn = $('.break-btn');
                           breakBtn.val('Break');
                       }


                       location.reload();

                   },
                   error: function(xhr, status, error) {
                       console.error('Request failed with status', xhr.status);
                   }
               });
           });
       }
   }
   // Function to handle geolocation errors
   function handleGeolocationError(error) {
       console.error('Error occurred while getting geolocation:', error);
   }

   // Get the user's geolocation
   if ('geolocation' in navigator) {
       navigator.geolocation.getCurrentPosition(handleGeolocation, handleGeolocationError);
   } else {
       console.error('Geolocation is not supported by this browser.');
   }

}, 1000);
</script>

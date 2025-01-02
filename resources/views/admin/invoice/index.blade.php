<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<head>
    <title></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />



    <style type="text/css">
        /* @font-face {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 400;
            src: url('/Lato/Lato-Regular.ttf') format('truetype');
        }

        @font-face {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 700;
            src: url('/Lato/Lato-Bold.ttf') format('truetype');
        } */


        * {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            /* font-family: 'Lato'; */
            letter-spacing: .8px;
            margin: 0;
            padding: 0;
            font-family: 'DejaVu Sans', sans-serif;
        }

        p {
            margin: 0;
            padding: 0;
        }
        .bold{
            font-weight: bold;
        }

        .ft10 {
            font-size: 10px;
            color: #000000;
        }

        .ft11 {
            font-size: 11px;
            color: #000000;
        }

        .ft12 {
            font-size: 12px;
            color: #000000;
        }

        .ft13 {
            font-size: 14px;
            color: #000000;
        }

        .ft14 {
            font-size: 14px;
            color: #000000;
        }

        .ft15 {
            font-size: 16px;
            /* line-height: 12px; */
            color: #000000;
        }

        .ft25 {
            font-size: 23px;
            /* line-height: 12px; */
            color: #000000;
        }

        .page {
            width:794px ;
            /* height: 1123px; */
            height: 1050px;
            margin: 0 auto;
            background: white;
            position: relative;
        }

        table {
            border-collapse: collapse;
        }

        #heading{
            background: gray;
            padding: 3px 2px;
            font-size: 15px
        }
        th {
            color: #000000;
            background: lightgray;
            padding: 3px 2px;
            font-size: 15px
        }
        td{
            padding: 5px 5px;
            text-align: center;
        }

        .totalDetail{
            border:1px solid black;
            background:lightGray;
            padding: 5px 3px;
        }

    </style>

</head>

<body bgcolor="lightgray" style="height: 100vh" vlink="blue" link="blue" >

    <div class="page" style="background-image: linear-gradient(
    rgba(255, 255, 255, 0.9),rgba(255, 255, 255, 0.9)),url('{{asset("images/logo.png")}}'); background-position:center ;background-repeat:no-repeat;background-size:400px">


        <p class="ft15" style="position: absolute; top:47px;left: 93px;font-size:14px">
            12750 S. Kirkwood, Suite # 200
        </p>
        <p class="ft15" style="position: absolute; top:62px;left: 93px;font-size:14px">
            Stafford, Tx, 77477
        </p>
        <p class="ft15" style="position: absolute; top:77px;left: 93px;font-size:14px">
            (281) 277-0077
        </p>


        <div style="position: absolute; top:35px;left:20PX; height:50px; width: 70px">
            <img src="{{asset('/images/logo.png')}}" alt="Not Found" width="100%" height="100%">
        </div>
        <div style="position: absolute; top:30px;left:93px;font-weight:bold;font-size:16px; ">
            STARTEX DISTRIBUTORS INC.
        </div>



        <div style="position: absolute; top:30px;right:20px;  font-size:30px">
            Invoice
        </div>


        {{-- detail --}}

        <p class="ft13 " style=" position: absolute; top:120px;left:30px;">Invoice No. </p>
        <p class="ft13 " style=" position: absolute; top:120px;left:110px;"> 0000{{ @$invoice->id }}</p>


        <p class="ft13 " style=" position: absolute; top:150px;left:30px;">Ship to:</p>
        <p class="ft13 " style=" position: absolute; top:150px;left:110px;">{{ @$invoice->order->address }} </p>


        {{-- <p class="ft13 " style=" position: absolute; top:10px;left:30px;">Reference : {{@$client['reference']}}</p> --}}



        {{-- right --}}



        <p class="ft13 " style=" position: absolute; top:120px;right:180px;">Invoice Date. </p>
        <p class="ft13 " style=" position: absolute; top:120px;right:30px;">{{ @$invoice->created_at }}</p>

        <p class="ft13 " style=" position: absolute; top:150px;right:180px;">Delivery Date:</p>
        <p class="ft13 " style=" position: absolute; top:150px;right:30px;">{{ @$invoice->order->date }}</p>

        <p class="ft13 " style=" position: absolute; top:170px;right:180px;">Bol Number:</p>
        <p class="ft13 " style=" position: absolute; top:170px;right:30px;">231241</p>
        <p class="ft13 " style=" position: absolute; top:190px;right:30px;">(MTP)</p>




        <table class="ft13" style="position: absolute; top:280px; left: 30px;  width: 60%;" >

            <tr style="border: 2px solid black">
                <th id="heading" colspan="11">
                    Gasoline
                </th>

            </tr>
            <tr>
                <th>
                    Item
                </th>
                <th>
                    Description
                </th>
                <th>
                    Gallons
                </th>
                <th>
                    Rack
                </th>
                <th>
                    Tax
                </th>
                <th>
                    Price
                </th>

                <th>
                    Amount
                </th>
            </tr>

            <tr>
                <td>
                    {{@$invoice->id}}
                </td>
                <td>
                    {{@$invoice->description}}
                </td>
                <td>
                    {{@$invoice->order->gallon}}
                </td>
                <td>
                    {{@$invoice->rack}}
                </td>
                <td>
                    {{@$invoice->tax}}
                </td>
                <td>
                    {{@$invoice->price}}
                </td>
                <td>
                    {{@$invoice->amount}}
                </td>

            </tr>

            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>

            </tr>
            <tr>
                <td></td>

            </tr>


            <tr style="background:lightgray">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{@$invoice->amount}}</td>
            </tr>

        </table>



        <table class="ft13" style="position: absolute; top:280px;right: 30px;  width: 30%;" >

            <tr style="border: 2px solid black">
                <th id="heading" colspan="11">
                    Credit Cards
                </th>

            </tr>
            <tr>
                <th>
                    Date
                </th>
                <th>
                    Ref
                </th>
                <th>
                    Net
                </th>

            </tr>

            <tr >
                <td>
                    {{@$invoice->card_date}}
                </td>
                <td>
                    {{@$invoice->card_ref}}
                </td>
                <td>
                    {{@$invoice->card_net}}

                </td>

            </tr>
        </table>





        <table class="ft13" style="position: absolute; bottom:50px; left: 30px;  width: 50%;" >

            <tr style="border: 2px solid black">
                <th id="heading" colspan="11">
                    Charges
                </th>

            </tr>
            <tr>
                <th>
                    Code
                </th>
                <th>
                    Description
                </th>
                <th>
                    Reference
                </th>
                <th>
                    Amount
                </th>

            </tr>
            <tr>
                <td>
                    04
                </td>
                <td>
                    Transportantion
                </td>
                <td>
                _
                </td>
                <td>
                    {{@$invoice->charges_transportation_amount}}

                </td>

            </tr>
            <tr>
                <td>
                    03
                </td>
                <td>
                    Gilborco PSO Fees
                </td>
                <td>
                    1761553170
                </td>
                <td>
                    {{@$invoice->charges_gilbarco_amount}}

                </td>

            </tr>
            <tr>
                <td>
                    05
                </td>
                <td>
                    Tx Delivery Fee
                </td>
                <td>
                    _
                </td>
                <td>
                    {{@$invoice->charges_tx_delivery_fee}}

                </td>

            </tr>
            <tr>
                <td>
                    11
                </td>
                <td>
                    Cybera
                </td>
                <td>
                    1761561065
                </td>
                <td>
                    {{@$invoice->charges_cybera}}

                </td>

            </tr>
            <tr>
                <td>
                    13
                </td>
                <td>
                    Fed Oil Spill fee
                </td>
                <td>
                    _
                </td>
                <td>
                    {{@$invoice->charges_fed_oil_spil_fee}}

                </td>

            </tr>
            <tr>
                <td>
                    35
                </td>
                <td>
                   Transport Surcharge
                </td>
                <td>
                    _
                </td>
                <td>
                    {{@$invoice->charges_transport_surcharge}}

                </td>

            </tr>

            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>

            </tr>
            <tr>
                <td></td>

            </tr>


            <tr style="background:lightgray">
                <td></td>
                <td></td>
                <td></td>
                <td>{{@$invoice->add_charges}}</td>
            </tr>

        </table>



        <div style="position: absolute; bottom:50px; right: 30px;width:40%; " >

            <div style="display: flex; margin-bottom:10px; width:100%">
                <div class="left" style="padding:5px 10px; background:gray;width:50%;text-align:end">Gross Amount</div>
                <div class="right" style="padding:5px 10px;border:2px solid black;width:50%">{{@$invoice->gross_amount}}</div>
            </div>
            <div style="display: flex;margin-bottom:10px;width:100%">
                <div class="left" style="padding:5px 10px; background:gray;width:50%;text-align:end">Add Charges</div>
                <div class="right" style="padding:5px 10px;border:2px solid black;width:50%">{{@$invoice->add_charges}}</div>
            </div>
            <div style="display: flex;margin-bottom:10px;width:100%">
                <div class="left" style="padding:5px 10px; background:gray;width:50%;text-align:end">Credit Cards</div>
                <div class="right" style="padding:5px 10px;border:2px solid black;width:50%">{{@$invoice->credit_cards}}</div>
            </div>
            <div style="display: flex;width:100%">
                <div class="left" style="padding:5px 10px; background:gray;width:50%;text-align:end">Net Amount</div>
                <div class="right" style="padding:5px 10px;border:2px solid black;width:50%">{{@$invoice->net_amount}}</div>
            </div>
        </div>
</body>

</html>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
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
            font-size: 13px;
            color: #000000;
        }

        .ft14 {
            font-size: 14px;
            color: #000000;
        }

        .ft15 {
            font-size: 15px;
            /* line-height: 12px; */
            color: #000000;
        }

        .ft25 {
            font-size: 23px;
            /* line-height: 12px; */
            color: #000000;
        }

        .page {
            width: 1123px;
            height:794px;
            margin: 0 auto;
            background: white;
            position: relative;
        }

        table {
            border-collapse: collapse;
        }

        th {
            color: #3496AF;
            padding: 5px;
        }
        /* @font-face {
            font-family: "Amiri", serif;
            font-weight: 400;
            font-style: normal;
        } */

        /* .arabic-text {
            font-family: "Amiri", serif;
            font-weight: 400;
            font-style: normal;
        } */

    </style>

</head>

<body bgcolor="#A0A0A0" vlink="blue" link="blue">

    <div class="page">

        <h2 style="color: gray; position: absolute; top:20px;left:20px;">SAFE EYES TRADING</h2>
        <h4 style="color: gray; position: absolute; top:60px;left:20px;">Gold & Jewellery</h4>


        <div style="position: absolute; top:10px;left:40%; width:200px">
            <img src="{{asset('/images/logo/logo.png')}}" alt="Not Found" width="100%">
        </div>



        <h3 style="color: gray; position: absolute; top:20px;right:20px;">SAFE EYES TRADING</h3>
        <p class="ft13" style=" position: absolute; top:45px;right:20px;">مؤسسة العيون الامنة </p>
        <p class="ft13" style=" position: absolute; top:65px;right:20px;">alazizyah </p>
        <p class="ft13" style=" position: absolute; top:90px;right:20px;">RIYADH 12831</p>
        <p class="ft13" style=" position: absolute; top:110px;right:20px;"> Saudi Arabia</p>

        <div style="position: absolute; top: 145px; left: 0px;right: 0; border-bottom: .5px solid rgb(178, 178, 178);">

            <!-- <hr> -->
        </div>


        <h4 style="color: gray; position: absolute; top:122px;left:48%;">{{@$sale->id . @$sale->branch_id}}</h4>


        <h4 style="color: gray; position: absolute; top:145px;left:40%;">CASH INVOICE فاتورة نقدية</h4>

        <div style="position: absolute; top:170px;left:40px; width:110px">
            <img src="{{asset('/images/logo/qr.JPG')}}" alt="Not Found" width="100%">
        </div>

        {{-- <p class="ft13 arabic-text" style=" position: absolute; top:230px;right:750px;">:<bdi>الرقم</bdi></p> --}}

        <p class="ft13 arabic-text" style=" position: absolute; top:230px;right:750px;">{{@$sale->created_at}} :تاريخ</p>

        <p class="ft13 arabic-text" style=" position: absolute; top:255px;right:750px;">{{@$sale->user->name}}:البانع</p>

        <p class="ft13" style=" position: absolute; top:175px;right:20px;">LEZOF COMPANY LTD. </p>

        <p class="ft13" style=" position: absolute; top:190px;right:20px;">VAT Number: 310294957900003
        </p>

        <p class="ft13 arabic-text" style=" position: absolute; top:230px;right:20px;"> {{@$sale->buyer_name}} :اسـم العميل</p>

        <p class="ft13 arabic-text" style=" position: absolute; top:255px;right:20px;"> {{@$sale->id . @$sale->branch_id}}:رقم العميل</p>


        <p class="ft25" style="position: absolute; top:300px;left:40px">
            Draft Invoice
        </p>

        <p class="ft25" style="position: absolute; top:300px;left:40%">
            INV/2024/{{@$sale->id }}
        </p>

        <p class="ft25" style="position: absolute; top:300px;right: 20px;">
            فاتورة مسودة
        </p>

        <table class="ft13" style="position: absolute; top:335px;right: 30px; left: 30px; border: 2px solid black; width: 94%;" border="2px solid black">

            <tr>
                <th>
                    السعر الاجمالي <br> TOTAL PRICE
                </th>
                <th>
                    اسم<br>Name
                </th>
                <th>
                    قيمة الضريبة <br>VAT AMOUNT
                </th>

                <th>
                    العدد<br>UNIT PRICE
                </th>
                <th>
                    ؤصف الصنف<br>QUANTITY
                </th>
                <th>
                    رقم الصنف<br>DESCRIPTION
                </th>
            </tr>
            {{-- <tr>
                <th>
                    السعر الاجمالي <br> TOTAL PRICE
                </th>
                <th>
                    قيمة الضريبة <br>VAT AMOUNT
                </th>

                <th>
                    مبلغ <br>AMOUNT
                </th>
                <th>
                    لضرائب <br>TAXES
                </th>
                <th>
                    سعر الوحدة <br>UNIT PRICE
                </th>
                <th>
                    ا لكمية <br>QUANTITY
                </th>
                <th>
                    الوصف <br>DESCRIPTION
                </th>
            </tr> --}}


            @foreach ($sale->saleItems as $item)

                <tr>
                    <td>
                        {{ @$item->price }}
                    </td>
                    <td>
                        {{@$item->inventory->name}}
                    </td>
                    <td>
                        {{$item->vat}}
                    </td>

                    <td>
                        {{@$item->inventory->price}}
                    </td>

                    <td>
                        {{@$item->quantity_sold}}
                    </td>
                    <td>
                        {{@$item->inventory->description}}
                    </td>
                </tr>
            @endforeach


        </table>

        <table class="ft13" style="position: absolute; bottom:180px;right: 30px; left: 30px; border: 2px solid black; " border="2px solid black">

            <tr>
                <td>
                    {{@$sale->price}}
                </td>
                <th>
                    الإجمالي الفرعي / Subtotal

                </th>
            </tr>
{{--
            <tr>
                <td>
                    VAT Taxes
                </td>
                <td>
                    {{@$item->vat}}
                </td>
            </tr> --}}

            <tr>
                <td>
                    {{@$sale->total_price}}
                </td>
                <td>
                    Total / المجموع
                </td>
            </tr>

        </table>

        <p class="ft12" style="position: absolute; bottom: 105px; right: 20px;">
            Payment Reference : رقم إشارة الدفعة: /2024/000016INV
        </p>


        <div style="position: absolute; bottom: 100px; left: 0px;right: 0; border-bottom: 2px solid rgb(178, 178, 178);">

            <!-- <hr> -->
        </div>

        <p class="ft15" style="position: absolute; bottom:60px;right: 34%;">
            0576650902 safeeyestrading@gmail.com
        </p>
        <p class="ft15" style="position: absolute; bottom:30px;right: 31%;">
            Riyadh Bank IBAN: SA6820000002463093139940
        </p>

    </div>

</body>

</html>

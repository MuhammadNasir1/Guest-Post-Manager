<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Horeca</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @media print {
            .backUrl {
                display: none !important;
            }
        }

        .backUrl {
            padding-top: 10px !important;
            position: absolute
        }

        .backUrl a {
            margin-left: 50px;
            font-size: 2rem;
            color: #027c56;
            font-family: Arial, Helvetica, sans-serif;

        }

        .container {
            height: 297mm;
            width: 210mm;
            background-color: #ffffff;
            margin: auto;
            position: relative
        }

        .header {
            height: 174px;
            width: 100%;
            border-bottom: 0.5px solid #ebedf2;
            background-color: #027c56;
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }

        .header-div1 h1 {
            font-family: "Inter", sans-serif;
            font-weight: 600px;
            color: #ffffff;
            font-size: 28px;
            margin: 0;
        }

        .header-div1 p {
            font-size: 17px;
            font-family: "Inter", sans-serif;
            font-weight: 700;
            color: #ffffff;
            padding-top: 10px;
        }

        .header-div1 ul li,
        .header-div2 ul li {
            list-style-type: none;
            font-size: 13px;
            font-family: "Inter", sans-serif;
            font-weight: 400;
            padding-top: 6px;
            color: #ffffff;
        }

        .header-div2 ul li {
            text-align: end;
        }

        .header-div2 .logo {
            display: flex;
            justify-content: flex-end;
        }

        .header-div2 .logo img {
            padding-left: 67px;
            width: 250px;
            margin-bottom: 10px;
        }

        .content {
            display: flex;
            justify-content: space-between;
            gap: 50px;
            padding: 20px 20px 20px 0px;
        }

        .content-div1 ul li {
            list-style-type: none;
            padding: 10px 0px 10px 20px;
            color: #000000;
        }

        .content-div1 ul li p {
            font-family: "Inter", sans-serif;
            font-size: 15px;
            font-weight: 600;
            line-height: 14px;
            padding-top: 5px;
            text-align: left;
        }

        .content-div1 ul .text {
            font-size: 11px;
        }

        .content-div2 {
            border: 0.5px solid #d7dae0;
            border-radius: 16px;
            height: 750px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .content-div2 table {
            width: 100%;
            padding: 10px 10px 0px 10px;
        }

        .content-div2 table {
            font-family: "Inter", sans-serif;
            color: #000000;
        }

        .content-div2 table thead {
            font-size: 18px;
        }

        .content-div2 table th,
        td {
            height: 50px;
            border-bottom: 0.5px solid #d7dae0;
        }

        .content-div2 table tbody {
            font-size: 15px;
            text-align: center;
        }

        .content-div2 table .description {
            width: 300px;
            text-align: left;
        }

        .content-div2 table .column1 {
            text-align: left;
        }

        .content-div2 table .column2 {
            width: 120px;
            text-align: center;
        }

        .content-div2 table .column3 {
            width: 50px;
            text-align: center;
        }

        .content-div2 table .column4 {
            width: 100px;
            text-align: center;
        }

        .color {
            color: #027c56;
        }

        .div2-2 {
            border: 0.5px solid #d7dae0;
            padding: 10px 0px 0px 0px;
        }

        .div2-2 .div2-left {
            display: flex;
            justify-content: space-between;
            padding: 0px 10px 0px 10px;
        }

        .div2-2 h2 {
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: 700;
            line-height: 14px;
            text-align: left;
            padding-top: 10px;
        }

        .table-footer {
            height: 34px;
            background-color: #027c56;
            margin-top: 15px;
        }

        .table-footer .footer-content {
            display: flex;
            justify-content: space-between;
            font-family: "Inter", sans-serif;
            font-size: 15px;
            font-weight: 700;
            line-height: 14px;
            text-align: left;
            color: #ffffff;
            padding: 10px 10px 0px 10px;
        }

        .contain {
            display: flex;
            justify-content: flex-end;
        }

        .signature {
            display: flex;
            justify-content: space-between;
            width: 80%;
            padding-right: 20px;
            font-family: "Inter", sans-serif;
            font-size: 15px;
            font-weight: 700;
            line-height: 14px;
            margin-top: 20px;
        }

        .footerdata {
            text-align: center;
            margin-top: 30px;
            font-family: Arial, Helvetica, sans-serif;

        }

        .footerdata p {
            font-size: 14px !important;
            margin-top: 5px;
            font-weight: 600;
        }

        footer {
            position: absolute;
            bottom: 0;
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 35px;
            background-color: #027c56;
            font-family: "Poppins", sans-serif;
        }

        footer h1 {
            line-height: 15px margin: 0;
            font-weight: 700;
            color: #ffffff;
            font-size: 14px;
        }

        .logo-text {

            color: white;
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: right;
            margin: 0;
        }
    </style>
</head>

<body>

    <div class="backUrl">
        <h3> <a href="../orders">@lang('lang.Go_Back_To_Orders')</a></h3>
    </div>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-div1">
                <h1>@lang('lang.INVOICE')</h1>
                <p>@lang('lang.Biled_To')</p>
                <ul>
                    <li>{{ $order->customer_name }}</li>
                    <li>{{ $order->customer_phone }}</li>
                    <li>{{ $order->customer_adress }}</li>
                </ul>
            </div>
            <div class="header-div2">
                <div class="logo"><img src="{{ asset('images/Horeca-White.svg') }}" alt="Logo" /></div>
                <p class="logo-text">@lang('lang.Food_Service_By') Kaya Markt</p>
                <div>
                    <ul>
                        <li>Kaya Markt GmbH & Co. KG, <br> Naubornerstraße 60, 35578 Wetzlar</li>
                    </ul>
                </div>
                {{-- <div>
                    <ul>
                        <li>Business Address</li>
                        <li>City, State, IN - 000 000</li>
                        <li>TAX ID 00XXXXX1234X0XX</li>
                    </ul>
                </div> --}}
            </div>

        </div>

        <!-- Content -->
        <div class="content">
            <div class="content-div1">
                <ul>
                    <li>
                        <p>@lang('lang.Invoice') #</p>
                        <p class="color text">{{ $order->id }}</p>
                    </li>
                    <li>
                        <p>@lang('lang.Invoice_Date')</p>
                        <p class="color text">{{ $order->order_date }}</p>
                    </li>
                </ul>
            </div>
            <div class="content-div2">
                <div>
                    <table>
                        <thead>
                            <div class="border-head">
                                <tr>
                                    <th class="description">@lang('lang.Description')</th>
                                    <th class="column2">@lang('lang.Qty')</th>
                                    <th class="column2">@lang('lang.Rate')</th>
                                    <th class="column3 text-1">@lang('lang.Tax')%</th>
                                    <th class="column3 text-1">@lang('lang.Total') </th>
                                </tr>
                            </div>
                            <div class="tr"></div>
                        </thead>

                        <tbody>
                            @foreach ($orderItems as $orderItem)
                                <h1></h1>
                                <tr class="font-size">
                                    <td class="column1">
                                        {{ $products->where('id', $orderItem->product_id)->first()->name }}</td>

                                    <td class="color">{{ $orderItem['product_quantity'] }}</td>

                                    <td class="color">{{ $orderItem['product_rate'] }}</td>

                                    <td class="color column3">{{ $orderItem['product_tax'] }}</td>
                                    <td class="color column4"><strong> {{ $orderItem['product_total'] }}&euro;</strong>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="div2-2">
                    <div class="div2-left">
                        <h2>@lang('lang.Sub_Total')</h2>
                        <h2 class="color">{{ $order->sub_total }}&euro;</h2>
                    </div>
                    <div class="div2-left">
                        <h2>@lang('lang.Sales_Tax') 7% (@lang('lang.from') &euro;0.00 @lang('lang.net') )</h2>
                        <h2 class="color">-</h2>
                    </div>
                    <div class="div2-left">
                        <h2>@lang('lang.Sales_Tax') 19% (@lang('lang.from') &euro;0.00 @lang('lang.net') )</h2>
                        <h2 class="color">-</h2>
                    </div>
                    <div class="div2-left">
                        <h2>@lang('lang.Delivery_Charges')</h2>
                        <h2 class="color">{{ $order->delivery_charges }}&euro;</h2>
                    </div>
                    <div class="div2-left">
                        <h2>@lang('lang.Discount')</h2>
                        <h2 class="color">{{ $order->discount }}%</h2>
                    </div>
                    <div class="table-footer">
                        <div class="footer-content">
                            <h3>@lang('lang.Grand_total') </h3>
                            <h3>{{ $order->grand_total }}&euro;</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contain">
            <div class="signature">
                <h4>@lang('lang.Prepared_By'): _______________</h4>

                <h4>@lang('lang.Recieved_By'): _______________</h4>
            </div>
        </div>
        <div>
            <div class="footerdata">
                <p>Amtsgericht Wetzlar HRA 7813 UST.-ID: DE331023882</p>
                <p>Kaya Markt GmbH & Co. KG Sparkasse Wetzlar IBAN: DE94 5155 0035 0002 1188 59 BIC: HELADEF1WET</p>
            </div>
        </div>
        <footer>
            <h1>@lang('lang.Software_Developed_By') The Web Concept</h1>
        </footer>
    </div>
</body>

</html>

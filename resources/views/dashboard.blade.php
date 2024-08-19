@include('layouts.header')
@include('layouts.nav')

<div class="mx-4 mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl ">@lang('lang.Dashboard')</h1>
    </div>
    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6  mt-4">
        <div class="card-1 ">
            <div class="bg-white  border border-secondary rounded-[10px] py-5 px-8">
                <div class="flex gap-1 justify-between items-center">
                    <div>
                        <p class="text-sm text-[#808191]">@lang('lang.Request_Invoice')</p>
                        <h2 class="text-2xl font-semibold mt-1">{{ $dasboard_data['total_invoices'] }}</h2>
                    </div>
                    <div>
                        <img width="52px" height=52px" src="{{ asset('images/icons/pending-orders.svg') }}"
                            alt="Pending Orders">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-1 ">
            <div class="bg-white  border border-secondary rounded-[10px] py-5 px-8">
                <div class="flex gap-1 justify-between items-center">
                    <div>
                        <p class="text-sm text-[#808191]">@lang('lang.Total_Sites')</p>
                        <h2 class="text-2xl font-semibold mt-1">{{ $dasboard_data['total_sites'] }}</h2>
                    </div>
                    <div>
                        <img width="60px" height="60px" src="{{ asset('images/icons/total-product.svg') }}"
                            alt="Product">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-1 ">
            <div class="bg-white  border border-secondary rounded-[10px] py-5 px-8">
                <div class="flex gap-1 justify-between items-center">
                    <div>
                        <p class="text-sm text-[#808191]">@lang('lang.Total_Users')</p>
                        <h2 class="text-2xl font-semibold mt-1">{{ $dasboard_data['total_user'] }}</h2>
                    </div>
                    <div>
                        <img width="50px" height="50px" src="{{ asset('images/icons/customers.svg') }}"
                            alt="User">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@if (session('user_det')['role'] == 'admin')
    <div class="lg:flex gap-14 mt-16 px-3 ">
        <div class="lg:w-[60%] w-full">
            <div class=" shadow-med p-3 rounded-xl">
                <h2 class="text-xl  font-semibold  ml-6">@lang('lang.Earning')</h2>
                <div id="earningChart" class="mt-4" style="height: 370px; width: 100%;"></div>

            </div>

        </div>
        <div class="lg:w-[40%] w-full">
            <div class=" shadow-med p-3 rounded-xl ">
                <div>
                    <div class="flex justify-between px-6">
                        <h2 class="text-xl  font-semibold ">@lang('lang.Request_Invoice')</h2>
                    </div>
                    <div id="attendanceChart" class="mt-4" style="height: 270px; width: 100%;"></div>
                    <div class="mt-8 mx-10">
                        <div class="flex justify-around">
                            <div class="flex flex-col items-center">
                                <p class="text-[#CECECE] text-lg font-semibold">@lang('lang.Pending')</p>
                                <h1 class="text-3xl font-semibold text-red-600">
                                    {{ $dasboard_data['invoice_chart']['pending'] }}</h1>
                            </div>
                            <div class="flex flex-col items-center">
                                <p class="text-[#CECECE] text-lg font-semibold">@lang('lang.Confirm')</p>
                                <h1 class="text-3xl font-semibold text-primary">
                                    {{ $dasboard_data['invoice_chart']['approved'] }}</h1>
                            </div>
                            <div class="flex flex-col items-center">
                                <p class="text-[#CECECE] text-lg font-semibold">@lang('lang.Processing')</p>
                                <h1 class="text-3xl font-semibold text-secondary">
                                    {{ $dasboard_data['invoice_chart']['processing'] }}</h1>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            CanvasJS.addColorSet("colors",
                [

                    "#417dfc",
                    "#339B96",
                    "#13242C",

                ]);
            var chart = new CanvasJS.Chart("earningChart", {
                animationEnabled: true,
                axisX: {
                    valueFormatString: "DDD",
                    minimum: new Date(Date.now() - 7 * 24 * 60 * 60 * 1000),
                    maximum: new Date(Date.now() + 7 * 24 * 60 * 60 * 1000),
                },
                axisY: {
                    gridColor: "#00000016",
                    lineDashType: "dot"
                },
                toolTip: {
                    shared: true
                },
                data: [{
                        name: "Debit",
                        type: "area",
                        fillOpacity: 100,
                        color: "#13242C",
                        markerSize: 0,
                        dataPoints: [
                            @foreach ($transactionData as $data)

                                {
                                    x: new Date("{{ $data['date'] }}"),
                                    y: {{ $data['total_debit'] }}
                                },
                            @endforeach
                        ]
                    },
                    {
                        name: "Credit",
                        type: "area",
                        fillOpacity: 100,
                        color: "#417DFC",
                        markerSize: 0,
                        dataPoints: [

                            @foreach ($transactionData as $data)

                                {
                                    x: new Date("{{ $data['date'] }}"),
                                    y: {{ $data['total_credit'] }}
                                },
                            @endforeach

                        ]
                    }
                ]
            });


            var chart3 = new CanvasJS.Chart("attendanceChart", {
                animationEnabled: true,

                data: [{
                    type: "doughnut",
                    startAngle: 60,
                    //innerRadius: 60,
                    indexLabelFontColor: "transparent",
                    indexLabelPlacement: "inside",
                    dataPoints: [{
                            y: {{ $dasboard_data['invoice_chart']['pending'] }},
                            color: "#C5443B",
                            label: "Pending"
                        },
                        {
                            y: {{ $dasboard_data['invoice_chart']['processing'] }},
                            color: "#417DFC",
                            label: "Processing"
                        },
                        {
                            y: {{ $dasboard_data['invoice_chart']['approved'] }},
                            color: "#13242C",
                            label: "Approved"
                        },

                    ]
                }]
            });

            chart.render();
            chart3.render();

        }
    </script>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
    integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@include('layouts.footer')

@include('layouts.header')
@include('layouts.nav')

<div class="mx-4 mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl ">@lang('lang.Dashboard')</h1>
    </div>
    <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6  mt-4">
        <div class="card-1 ">
            <div class="bg-white  border border-secondary rounded-[10px] py-5 px-8">
                <div class="flex gap-1 justify-between items-center">
                    <div>
                        <p class="text-sm text-[#808191]">@lang('lang.Total_orders')</p>
                        <h2 class="text-2xl font-semibold mt-1">{{ $totalOrders }}</h2>
                    </div>
                    <div>
                        <img width="60px" height="60px" src="{{ asset('images/icons/total_orders.svg') }}"
                            alt="Orders">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-1 ">
            <div class="bg-white  border border-secondary rounded-[10px] py-5 px-8">
                <div class="flex gap-1 justify-between items-center">
                    <div>
                        <p class="text-sm text-[#808191]">@lang('lang.Pending_orders')</p>
                        <h2 class="text-2xl font-semibold mt-1">{{ $pendingOrders }}</h2>
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
                        <p class="text-sm text-[#808191]">@lang('lang.Total_product')</p>
                        <h2 class="text-2xl font-semibold mt-1">{{ $totalProduct }}</h2>
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
                        <p class="text-sm text-[#808191]">@lang('lang.Total_customers')</p>
                        <h2 class="text-2xl font-semibold mt-1">{{ $totalUser }}</h2>
                    </div>
                    <div>
                        <img width="50px" height="50px" src="{{ asset('images/icons/customers.svg') }}"
                            alt="Customers">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="lg:flex gap-14 mt-16 px-3 ">
    <div class="lg:w-[60%] w-full">
        <div class=" shadow-med p-3 rounded-xl">
            <h2 class="text-xl  font-semibold  ml-6">@lang('lang.Earning')</h2>
            <div id="earningChart" class="mt-4" style="height: 370px; width: 100%;"></div>

        </div>


        <div class=" shadow-med p-3 py-5  mt-8 rounded-xl min-h-[448px]">
            <div class="flex justify-between px-6">
                <h2 class="text-xl  font-semibold ">@lang('lang.Top_Product')</h2>

            </div>
            <div>
                <div class="pt-3  mt-2 border-t  border-gray-200">

                    <div class="relative overflow-auto h-[300px] ">
                        <table class="w-full text-sm text-center ">
                            <thead class="text-sm text-gray-900  text-dblue ">
                                <tr>
                                    <th class="px-6 py-3">
                                        @lang('lang.Code')
                                    </th>
                                    <th class="px-6 py-3">
                                        @lang('lang.Photo')
                                    </th>
                                    <th class="px-6 py-3">
                                        @lang('lang.Name')
                                    </th>
                                    <th class="px-6 py-3">
                                        @lang('lang.Rank')
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $i => $product)
                                    <tr class="bg-white ">
                                        <td class="px-6 py-3 ">
                                            {{ $product->id }}
                                        </td>
                                        <td class="px-6 py-3 flex  justify-center">
                                            <img src="{{ isset($product->image) ? asset($product->image) : asset('images/favicon(32X32).png') }}"
                                                width="70px" class="rounded-md" alt="Product">
                                        </td>
                                        <td class="px-6 py-3">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="flex items-center justify-center flex-col">
                                                <div>
                                                    <p class="text-dblue flex">{{ $i + 1 }}</p>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="lg:w-[40%] w-full">
        <div class=" shadow-med p-3 rounded-xl">
            <h2 class="text-xl  font-semibold ml-6">@lang('lang.Orders')</h2>
            <div id="studentChart" class="mt-4" style="height: 370px; width: 100%;"></div>
        </div>
        <div class=" shadow-med p-3 rounded-xl mt-10">

            <div>
                <div class="flex justify-between px-6">
                    <h2 class="text-xl  font-semibold ">@lang('lang.Orders')</h2>
                </div>
                <div id="attendanceChart" class="mt-4" style="height: 270px; width: 100%;"></div>
                <div class="mt-8 mx-10">
                    <div class="flex justify-around">
                        <div class="flex flex-col items-center">
                            <p class="text-[#CECECE] text-lg font-semibold">@lang('lang.Pending')</p>
                            <div class="h-10  w-10 bg-secondary rounded-full">

                            </div>
                        </div>
                        <div class="flex flex-col items-center">
                            <p class="text-[#CECECE] text-lg font-semibold">@lang('lang.Confirm')</p>
                            <div class="h-10  w-10 bg-primary rounded-full">

                            </div>
                        </div>

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

                "#EDBD58",
                "#339B96",
                "#027C56",

            ]);
        var chart = new CanvasJS.Chart("earningChart", {
            animationEnabled: true,
            axisX: {
                valueFormatString: "DDD",
                minimum: new Date(Date.now() - 7 * 24 * 60 * 60 * 1000),
                maximum: new Date(Date.now() + 7 * 24 * 60 * 60 * 1000)
            },
            axisY: {
                gridColor: "#00000016",
                lineDashType: "dot"
            },
            toolTip: {
                shared: true
            },
            data: [{

                name: "Sent",
                type: "area",
                color: "#027C56",
                fillOpacity: 100,
                markerSize: 2,
                dataPoints: [

                    @foreach ($dailySalesData as $data)
                        {
                            x: new Date({{ $data['date'] }}),
                            y: {{ $data['total'] }}
                        }, {
                            x: new Date(2024, 4, 30),
                            y: 150
                        },
                    @endforeach


                ]
            }]
        });

        var chart2 = new CanvasJS.Chart("studentChart", {
            colorSet: "colors",
            animationEnabled: true,
            theme: "light1",
            axisY: {
                gridColor: "#00000016",
                suffix: "-"

            },

            data: [{
                type: "column",
                yValueFormatString: "#,##0.0#\"\"",
                dataPoints: [
                    @foreach ($orderData as $data)
                        {
                            label: "{{ $data['month'] }}",

                            y: {{ $data['order_count'] }}
                        },
                    @endforeach


                ]
            }]
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
                        y: {{ $pendingOrders }},
                        color: "#edbd58",
                        label: "Pending Orders"
                    },
                    {
                        y: {{ $confirmedOrders }},
                        color: "#027C56",
                        label: "Complete Orders"
                    },

                ]
            }]
        });
        chart.render();
        chart2.render();
        chart3.render();

    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
    integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@include('layouts.footer')

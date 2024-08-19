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


<div class="lg:flex gap-14 mt-16 px-3 ">
    <div class="lg:w-[60%] w-full">
        <div class=" shadow-med p-3 rounded-xl">
            <h2 class="text-xl  font-semibold  ml-6">@lang('lang.Earning')</h2>
            <div id="earningChart" class="mt-4" style="height: 370px; width: 100%;"></div>

        </div>

    </div>
    <div class="lg:w-[40%] w-full">
        <div class=" shadow-med p-3 rounded-xl">
            <h2 class="text-xl  font-semibold ml-6">@lang('lang.Orders')</h2>
            <div id="studentChart" class="mt-4" style="height: 370px; width: 100%;"></div>
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
                minimum: new Date(2017, 1, 5, 23),
                maximum: new Date(2017, 1, 12, 1)
            },
            axisY: {
                gridColor: "#00000016",
                lineDashType: "dot"
            },
            toolTip: {
                shared: true
            },
            data: [{
                name: "Received",
                type: "area",
                fillOpacity: 100,
                color: "#13242C",
                markerSize: 0,
                dataPoints: [{
                        x: new Date(2017, 1, 6),
                        y: 550
                    },
                    {
                        x: new Date(2017, 1, 7),
                        y: 450
                    },
                    {
                        x: new Date(2017, 1, 8),
                        y: 500
                    },
                    {
                        x: new Date(2017, 1, 9),
                        y: 162
                    },
                    {
                        x: new Date(2017, 1, 10),
                        y: 150
                    },
                    {
                        x: new Date(2017, 1, 11),
                        y: 400
                    },
                    {
                        x: new Date(2017, 1, 12),
                        y: 129
                    }
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
                dataPoints: [{
                        label: "Jan",

                        y: 78
                    },
                    {
                        label: "Feb",
                        y: 55
                    },
                    {
                        label: "Mar",
                        y: 80
                    },
                    {
                        label: "Apr",
                        y: 60
                    },


                ]
            }]
        });


        chart.render();
        chart2.render();

    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
    integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@include('layouts.footer')

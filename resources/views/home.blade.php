@include('layouts.header')


@php
    $company = DB::table('companies')->first();
@endphp

<style>
    .hero-section {
        background-image: linear-gradient(rgba(0, 0, 0, 0.456), rgba(0, 0, 0, 0.456)), url("/images/pexels-pranjalsrivastava9-2403251.jpg");
        background-size: cover;
        background-position: center;
    }
</style>

<nav class=" hero-section dark:bg-gray-900  w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img class="w-48"
                src="{{ isset($company->logo) ? asset($company->logo) : asset('images/comapnylogo.svg') }}"
                alt="logo">
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <a href="../login">
                <button type="button"
                    class="text-white bg-transparent border border-white hover:border-black duration-500 hover:bg-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium
                 rounded-lg text-sm px-6 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
            </a>

        </div>

    </div>

    {{-- Hero Section --}}
    <section class="flex h-[70vh] justify-center items-center">

        <form action="../search" method="get" class="flex items-center max-w-lg mx-auto">
            <label for="voice-search" class="sr-only">Search</label>
            <div class="relative w-[50vw]">

                <div>
                    <input type="text"
                        class=" border border-white text-gray-900 text-sm rounded-lg focus:rounded-b-none bg-white  focus:border-white block w-full ps-5 p-2.5  dark:bg-gray-700  placeholder:text-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search Websites..." required name="query" id="searchInput" autocomplete="off" />
                </div>


                <div class="absolute top-10 h-[200px] w-full bg-white rounded-b-lg hidden" id="siteArea">

                    <ul class="ml-4 mt-2 min-h-56" id="resOutput">
                        <li class="text-center siteList">No Website Found</li>

                    </ul>
                </div>

            </div>
            <button type="submit"
                class="inline-flex items-center py-3 px-4 duration-500 ms-2 text-sm font-medium text-white bg-black rounded-lg border border-black  hover:bg-transparent focus:border-white focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </button>
        </form>

    </section>
</nav>

<h1 class="text-center p-5 font-bold text-3xl">@lang('lang.Website_Details')</h1>
<div class="grid lg:grid-cols-4 grid-cols-2  px-5 pb-5">
    <div class="py-5 px-5 border flex items-center font-bold">
        @lang('lang.STN')
    </div>
    <div class="py-5 px-5 border flex items-center" id="stn">

    </div>
    <div class="py-5 px-5 border flex items-center font-bold">
        @lang('lang.Website_URL')
    </div>
    <div class="py-5 px-5 border flex items-center">
        <a href="https:://www.youtube.com" id="url"></a>
    </div>
    <div class="py-5 px-5 border flex items-center font-bold">
        @lang('lang.Traffic')
    </div>
    <div class="py-5 px-5 border flex items-center" id="traffic">

    </div>
    <div class="py-5 px-5 border flex items-center font-bold">
        @lang('lang.Semrush_Traffic')
    </div>
    <div class="py-5 px-5 border flex items-center" id="semrushTraffic">

    </div>
    <div class="py-5 px-5 border flex items-center font-bold">
        @lang('lang.Ahref_Traffic')
    </div>
    <div class="py-5 px-5 border flex items-center" id="hrefTraffic">

    </div>
    <div class="py-5 px-5 border flex items-center font-bold">
        @lang('lang.Guest_Post_Price')
    </div>
    <div class="py-5 px-5 border flex items-center" id="price">

    </div>
    <div class="py-5 px-5 border flex items-center font-bold">
        @lang('lang.Link_Insertion_Price')
    </div>
    <div class="py-5 px-5 border flex items-center" id="linkInser">

    </div>
    <div class="py-5 px-5 border flex items-center font-bold">
        @lang('lang.Exchange')
    </div>
    <div class="py-5 px-5 border flex items-center" id="exchange">

    </div>

</div>


@include('layouts.footer')

<script>
    $(document).ready(function() {
        $('#searchInput').on('focus', function() {
            $('#siteArea').removeClass('hidden').addClass('block');
        });
        $('#searchInput').on('input', function() {
            let query = $('#searchInput').val();
            $.ajax({
                type: "Get",
                url: "/search",
                data: {
                    "query": query,
                },
                success: function(response) {
                    let Alldata = response.data;
                    let resOutput = $('#resOutput');
                    resOutput.html('');
                    Alldata.forEach(data => {
                        let outputData =
                            `<span url="siteData/${data.id}" class="siteList cursor-pointer"><li>${data.web_url}</li></span>`;
                        resOutput.append(outputData);
                    });
                    getSiteData();

                },

            });
        });

        function getSiteData() {
            $('.siteList').click(function() {
                let url = $(this).attr('url');
                $.ajax({
                    type: "Get",
                    url: url,
                    success: function(response) {
                        let data = response.data
                        $("#stn").text(data.id)
                        $("#url").text(data.web_url)
                        $("#traffic").text(data.traffic)
                        $("#semrushTraffic").text(data.semrush_traffic)
                        $("#hrefTraffic").text(data.ahref_traffic)
                        $("#price").text(data.guest_post_price)
                        $("#linkInser").text(data.link_insertion_price)
                        $("#exchange").text(data.exchange)

                    }
                });
            });
        }
        getSiteData();


    });
</script>

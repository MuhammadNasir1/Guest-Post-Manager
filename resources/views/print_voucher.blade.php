@include('layouts.header')


<div class="flex gap-5 items-center justify-center mt-5 border-b-2  pb-10">
    <img src="{{ asset('../images/your-logo.jpg') }}" width="100" alt="">
    <div>
        <h1 class="pb-3 text-red-600 text-3xl font-bold">Your Company</h1>
        <p class="ps-1">PH NO: 0303111111</p>
    </div>
</div>

<div class="border-b-2 pb-20 ">
    <div class="flex justify-between mt-10 px-5">


        <div>
            <h1 class="pb-1  text-2xl font-bold">Details</h1>
            <h1 class="pb-2  text-3xl font-bold">Cash In Hand</h1>
            <p class="ps-1">0</p>
        </div>


        <div>
            <h2 class="pb-2.5 text-3xl font-bold">Voucher : <span class="font-bold ps-3">{{ $print->id }}</span>
            </h2>
            <h2 class="pb-2.5  font-bold">Vendor Type : <span class="font-light ps-3">General Voucher</span> </h2>
            <h2 class="pb-2.5  font-bold">Vendor Date/Time : <span class="font-light ps-3">Tue 29-August-2024 12:35
                    <h2 class="pb-2.5  font-bold">Added By : <span class="font-light ps-3">Admin</span>
                    </h2>
                    <h2 class="pb-2.5  font-bold">Type : <span class="font-light ps-3">Bank</span>
                    </h2>

        </div>


    </div>
    <div class="mt-10 px-5 w-full">
        <table class="w-full">

            <body>
                <tr>
                    <th class="py-3 border px-5">Amount Paid</th>
                    <td class="border px-5">5,000</td>
                    <th class="border px-5">Previous Balance</th>
                    <td class="border px-5">5,000</td>
                    <th class="border px-5">Current Balance</th>
                    <td class="border px-5">5,000</td>
                </tr>
                <tr>
                    <th class="py-3 px-5  border">Narration</th>
                    <td class="border px-5" colspan="5">{{ $print->hint }}</td>
                </tr>
            </body>
        </table>
    </div>

    <div class="flex justify-between items-end mt-10 px-5">


        <div class="flex gap-3">
            {{-- <div class="w-[5px] h-[54px] bg-black mt-3"></div> --}}
            <div>
                <h1 class="pb-2">Thank You So Much For Choosing <span class="text-2xl font-bold pt-2">Your
                        Company</span>
                </h1>
                <h1 class="">Software Developed By <span class="text-2xl font-bold">The Web Concept</span></h1>
            </div>
        </div>


        <div>
            <h2 class="pb-2.5 text-xl font-bold">Customer Copy</h2>


        </div>


    </div>
    <div class="flex justify-between items-center mt-10 px-5">

        <div>
            <h2 class="inline-block font-bold text-xl">Prepared By : _____________</h2>
        </div>

        <div>
            <h2 class="inline-block font-bold text-xl">Recieved By : _____________</h2>
        </div>

    </div>
</div>

@include('layouts.footer')

@include('layouts.header')

<div class="flex gap-5 items-center justify-center mt-5 border-b-2  pb-10">
    @php
        $company = DB::table('companies')->first();
    @endphp

    <img src="{{ isset($company->logo) ? asset($company->logo) : asset('images/your-logo.jpg') }}" width="100"
        alt="">
    <div>
        <h1 class="pb-3 text-red-600 text-3xl font-bold">{{ $company->name ?? 'The Web Concept' }}</h1>
        <p class="ps-1">@lang('lang.PH_NO') : {{ $company->phone_no ?? '123 456 789' }}</p>
    </div>
</div>

<div class="border-b-2 pb-20 ">
    <div class="flex justify-between mt-10 px-5">


        <div>
            <h1 class="pb-1  text-2xl font-bold">@lang('lang.Details')</h1>
            <h1 class="pb-2  text-3xl font-bold">@lang('lang.Cash_In_Hand')</h1>
            <p class="ps-1">0</p>
        </div>


        <div>
            <h2 class="pb-2.5 text-3xl font-bold">@lang('lang.Voucher') : <span
                    class="font-bold ps-3">{{ $print->id }}</span>
            </h2>
            <h2 class="pb-2.5  font-bold">@lang('lang.Vendor_Type') : <span class="font-light ps-3">@lang('lang.General_Voucher')</span>
            </h2>
            <h2 class="pb-2.5  font-bold">@lang('lang.Vendor_Date_Time') : <span class="font-light ps-3">Tue 29-August-2024 12:35
                    <h2 class="pb-2.5  font-bold">@lang('lang.Added_By') : <span class="font-light ps-3">Admin</span>
                    </h2>
                    <h2 class="pb-2.5  font-bold">@lang('lang.Type') : <span class="font-light ps-3">Bank</span>
                    </h2>

        </div>


    </div>
    <div class="mt-10 px-5 w-full">
        <table class="w-full">

            <body>
                <tr>
                    <th class="py-3 border px-5">@lang('lang.Amount_Paid')</th>
                    <td class="border px-5">
                        @if ($print->debit == null)
                            0
                        @else
                            {{ $print->debit }}
                        @endif
                    </td>
                    <th class="border px-5">@lang('lang.Previous_Balance')</th>
                    <td class="border px-5">{{ $print->debit - $print->credit - $print->debit }}</td>
                    <th class="border px-5">@lang('lang.Current_Balance')</th>
                    <td class="border px-5">{{ $print->debit - $print->credit }}</td>
                </tr>
                <tr>
                    <th class="py-3 px-5  border">@lang('lang.Narration')</th>
                    <td class="border px-5" colspan="5">{{ $print->hint }}</td>
                </tr>
            </body>
        </table>
    </div>

    <div class="flex justify-between items-end mt-10 px-5">


        <div class="flex gap-3">
            {{-- <div class="w-[5px] h-[54px] bg-black mt-3"></div> --}}
            <div>
                <h1 class="pb-2">@lang('lang.Thank_You_So_Much_For_Choosing') <span
                        class="text-2xl font-bold pt-2">{{ $company->name ?? 'The Web Concept' }}</span>
                </h1>
                <h1 class="">@lang('lang.Software_Developed_By') <span class="text-2xl font-bold">The Web Concept</span></h1>
            </div>
        </div>


        <div>
            <h2 class="pb-2.5 text-xl font-bold">@lang('lang.Customer_Copy')</h2>


        </div>


    </div>
    <div class="flex justify-between items-center mt-10 px-5">

        <div>
            <h2 class="inline-block font-bold text-xl">@lang('lang.Prepared_By') : _____________</h2>
        </div>

        <div>
            <h2 class="inline-block font-bold text-xl">@lang('lang.Recieved_By') : _____________</h2>
        </div>

    </div>
</div>

@include('layouts.footer')

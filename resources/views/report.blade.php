@include('layouts.header')
@include('layouts.nav')
<div class="md:mx-4 mt-12">

    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end lg:justify-between px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden lg:block">@lang('lang.Reports_List')</h3>
                <form action="../report" method="get">
                    <div class="flex gap-x-4 gap-y-0 items-center flex-wrap justify-end">

                        <div class="mb-1  w-full  md:w-auto">
                            <label class="text-[14px] font-normal" for="from_date">@lang('lang.From_Date')</label>
                            <br>
                            <input type="date"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="from_date" id="from_date">
                        </div>
                        <div class="mb-1  w-full  md:w-auto">
                            <label class="text-[14px] font-normal" for="to_date">@lang('lang.To_Date')</label>
                            <br>
                            <input type="date"
                                class=" border-[#DEE2E6] rounded-[4px] w-full focus:border-primary   h-[40px] text-[14px]"
                                name="to_date" id="to_date">
                        </div>
                        <div class="md:w-36  mt-5   w-full ">
                            <select
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="interval" id="interval">
                                <option value=""> @lang('lang.Select_Interval')</option>
                                <option value="today"> @lang('lang.Today')</option>
                                <option value="last_week"> @lang('lang.This_Week')</option>
                                <option value="last_month"> @lang('lang.This_Month')</option>
                            </select>

                        </div>
                        <div>

                            <button
                                class="bg-primary cursor-pointer text-white h-10 px-5 rounded-[6px] mt-5 shadow-sm font-semibold ">
                                @lang('lang.Get_Report')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="overflow-x-auto px-5 pb-10 pt-5">
                <table id="datatable" class="overflow-scroll">
                    <thead class="py-6 bg-primary text-white">
                        <tr>
                            <th class="py-3">@lang('lang.STN')</th>
                            <th class="border-2 border-primary whitespace-nowrap">@lang('lang.Customer_Name')</th>
                            <th class="border-2 border-primary whitespace-nowrap">@lang('lang.Customer_phone')</th>
                            <th class="border-2 border-primary whitespace-nowrap">@lang('lang.Customer_Address')</th>
                            <th class="border-2 border-primary whitespace-nowrap">@lang('lang.Total')</th>
                            <th class="border-2 border-primary whitespace-nowrap">@lang('lang.Discount') /
                                @lang('lang.Delivery_Charges') </th>
                            <th class="border-2 border-primary whitespace-nowrap">@lang('lang.Grand_total')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $i => $report)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $report->customer_name }}</td>
                                <td>{{ $report->customer_phone }}</td>
                                <td>{{ $report->customer_adress }}</td>
                                <td>{{ $report->sub_total }}</td>
                                <td>{{ $report->discount }}% / {{ $report->delivery_charges }}&euro;</td>
                                <td class="grandTotal">{{ $report->grand_total }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <td colspan="7" class="pr-5  w-full ">
                            <div class="text-right font-bold text-[23px]">@lang('lang.Total_Sale'):
                                <span class="text-primary " id="total-sale">500</span><span
                                    class="text-primary ">&euro;</span>
                            </div>
                        </td>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>





@include('layouts.footer')
<script>
    $(document).ready(function() {
        var total = 0;

        $('.grandTotal').each(function() {
            var value = parseFloat($(this).text());
            if (!isNaN(value)) {
                total += value;
            }
        });
        $('#total-sale').text(total);
    });
</script>

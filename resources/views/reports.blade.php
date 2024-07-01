@include('layouts.header')
@include('layouts.nav')
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .invoice,
        .invoice * {
            visibility: visible;
        }

        .invoice {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;

        }
    }
</style>
<div class="lg:mx-4 mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl ">@lang('lang.Customer_Ledger')</h1>
    </div>

    <div id="reloadDiv" class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        {{-- <form action="../getLedgerData" method="get" enctype="multipart/form-data"> --}}
        <form id="ledgerDataForm" method="get" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="" autocomplete="off">
            <div class="p-8">

                <div class="get-report flex justify-between items-center pb-10">
                    <div class="flex gap-5">
                        <div class="pt-0.5">
                            <label class="text-[14px] font-normal" for="customer_account">@lang('lang.Customer_Account')</label>
                            <select
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[40px] text-[14px]"
                                name="customer_account" id="customer_account" required onchange="show()">
                                <option selected disabled>@lang('lang.Select_Account')</option>
                                @foreach ($users as $users)
                                    <option value="{{ $users->id }}">{{ $users->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="from_date">@lang('lang.From_Date')</label>
                            <input type="date"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[35px] mt-0.5 text-[14px]"
                                name="from_date" id="from_date">
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="total_amount">@lang('lang.To_Date')</label>
                            <input type="date"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[35px] mt-0.5 text-[14px]"
                                name="to_date" id="to_date">
                        </div>
                    </div>
                    <div class="flex pt-4 gap-5 items-center">
                        <button
                            class="bg-blue-600 text-white py-1.5 px-6  rounded-[4px]   uaddBtn  font-semibold ">@lang('lang.Print_Report')</button>
                        <button
                            class="bg-primary text-white py-1.5 px-6  rounded-[4px]   uaddBtn  font-semibold ">@lang('lang.Full_Details')</button>
                        <button
                            class="bg-red-600 text-white py-1.5 px-6  rounded-[4px]   uaddBtn  font-semibold ">@lang('lang.Ledger_Details')</button>
                    </div>
                </div>


                {{--  --}}
                <div class="invoice">
                    <div class="report pt-10 border-t border-gray ">
                        <div class="flex justify-between items-center">
                            <div class="flex gap-5 items-center">
                                <img src="{{ asset('../images/your-logo.jpg') }}" width="100" alt="">
                                <div>
                                    <h1 class="pb-3 text-red-600 text-3xl font-bold">Your Company</h1>
                                    <p class="ps-1">PH NO: 0303111111</p>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <h2 class="pb-2.5 font-bold">Account Name: <span class="font-light ps-3">M-Arham
                                            Waheed</span></h2>
                                    <h2 class="pb-2.5 font-bold">Phone No: <span
                                            class="font-light ps-3">012345678</span>
                                    </h2>

                                </div>
                            </div>
                        </div>

                        <div class="text-center py-5 font-bold mt-5 border-t border-gray">
                            <h2>OverAll</h2>
                        </div>

                        <div>
                            <table class="w-full" id="transactionTable">
                                <thead>
                                    <tr>
                                        <th class="py-5 border-2 border-gray">@lang('lang.Transaction') #</th>
                                        <th class="border-2 border-gray">@lang('lang.Date')</th>
                                        <th class="border-2 border-gray">@lang('lang.Transfer_From')</th>
                                        <th class="border-2 border-gray">@lang('lang.Remarks')</th>
                                        <th class="border-2 border-gray">@lang('lang.Debit')</th>
                                        <th class="border-2 border-gray">@lang('lang.Credit')</th>
                                        <th class="border-2 border-gray">@lang('lang.Balance')</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>

                                    <tr>
                                        <td class="py-3 text-right border border-gray font-bold" colspan="6">
                                            @lang('lang.Opening_Balance')
                                        <td class="py-3 text-center border border-gray font-bold text-green-400"
                                            colspan="4" id="openingBalance">0
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 text-right border border-gray font-bold" colspan="6">
                                            @lang('lang.Total_Debits')
                                        <td class="py-3 text-center border border-gray font-bold text-green-400"
                                            colspan="4" id="totalDebits">0
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 text-right border border-gray font-bold" colspan="6">
                                            @lang('lang.Total_Credits')
                                        <td class="py-3 text-center border border-gray font-bold text-yellow-300"
                                            colspan="4" id="totalCredits">0
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 text-right border border-gray font-bold" colspan="6">
                                            @lang('lang.Closing_Balance')
                                        <td class="py-3 text-center border border-gray font-bold text-green-400"
                                            colspan="4" id="closingBalance">0
                                        </td>
                                    </tr>
                                    </tr>
                                    </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="mt-10  flex justify-end">
                    <button class="bg-secondary  text-white h-12 px-3 rounded-[6px]  shadow-sm font-semibold "
                        id="addBtn">
                        <div class=" text-center hidden" id="spinner">
                            <svg aria-hidden="true"
                                class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="text">
                            Save
                        </div>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')

<script>
    $(document).ready(function() {
        $('#ledgerDataForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $customerId = $('#customer_account').val();
            $fromData = $('#from_date').val();
            $toDate = $('#to_date').val();


            $openingBalance = $('#openingBalance');
            $totalDebits = $('#totalDebits');
            $totalCredits = $('#totalCredits');
            $closingBalance = $('#closingBalance');

            $.ajax({
                type: "Get",
                url: "../getLedgerData",
                // data: formData,
                data: {

                    "customer_account": $customerId,
                    "from_date": $fromData,
                    "to_date": $toDate,
                },
                dataType: "json",
                success: function(response) {
                    var transactions = response.data;
                    var newRows = '';
                    var tDebits = 0;
                    var tCredits = 0;
                    transactions.forEach(function(transaction) {

                        var debit = parseFloat(transaction.debit) || 0;
                        var credit = parseFloat(transaction.credit) || 0;
                        tDebits += debit;
                        tCredits += credit;
                        var newRow =
                            `<tr>
                                <td class="py-3 text-center border border-gray">${transaction.id}</td>
                                <td class="py-3 text-center border border-gray">${transaction.created_at}</td>
                                <td class="py-3 text-center border border-gray">${transaction.transaction_form}</td>
                                <td class="py-3 text-center border border-gray">${transaction.transaction_remarks}</td>
                                <td class="py-3 text-center border border-gray font-bold text-blue-500">${transaction.debit}</td>
                                <td class="py-3 text-center border border-gray font-bold text-green-500">${transaction.credit}</td>
                                <td class="py-3 text-center border border-gray font-bold text-red-600">${transaction.balance}</td>
                                 </tr>`;


                        newRows += newRow;
                    });

                    // Appending the new rows to the table body
                    $('#transactionTable tbody').append(newRows);
                    $('#totalDebits').text(tDebits);
                    $('#totalCredits').text(tCredits);
                },

            })

        })

    })
</script>

@include('layouts.header')
@include('layouts.nav')

<style>
    @media print {

        /* body * {
            visibility: hidden;
        } */
        #mainDiv {
            visibility: hidden;
            position: absolute;
        }

        #Navbar {
            display: none;
            position: absolute
        }

        #sidebar {
            display: none;
            position: absolute
        }

        #content {
            margin-left: -100px !important;
            /* display: none */
            margin: 0;
            padding: 0;
        }

        .invoice,
        .invoice * {
            width: 100%;
            visibility: visible;
        }

        .invoice {
            width: 100%;
            height: 100%;

        }
    }
</style>
@php
    $company = DB::table('companies')->first();
@endphp

<div class="lg:mx-4 mt-12" id="mainDiv">
    <div>
        <h1 class=" font-semibold   text-2xl ">@lang('lang.Customer_Ledger')</h1>
    </div>

    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        {{-- <form action="../getLedgerData" method="get" enctype="multipart/form-data"> --}}
        <form id="ledgerDataForm" method="get" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="" autocomplete="off">
            <div class="p-8">

                <div class="get-report flex justify-between items-center pb-10">
                    <div class="flex gap-5">
                        @if (session('user_det')['role'] == 'admin')
                            <div class="pt-0.5">
                                <label class="text-[14px] font-normal" for="customer_account">@lang('lang.Customer_Account')</label>
                                <select
                                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[40px] text-[14px]"
                                    name="customer_account" id="customer_account" required>
                                    <option selected disabled>@lang('lang.Select_Account')</option>
                                    @foreach ($users as $users)
                                        <option value="{{ $users->id }}">{{ $users->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        @else
                            <input type="hidden" value="{{ session('user_det')['user_id'] }}" id="customer_account"
                                name="customer_account">
                        @endif
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
                        {{-- <button
                            class="bg-blue-600 text-white py-1.5 px-6  rounded-[4px]   uaddBtn  font-semibold ">@lang('lang.Print_Report')</button> --}}
                        {{-- <button
                            class="bg-primary text-white py-1.5 px-6  rounded-[4px]   uaddBtn  font-semibold ">@lang('lang.Full_Details')</button> --}}
                        <button
                            class="bg-red-600 text-white py-1.5 px-6  rounded-[4px]   uaddBtn  font-semibold ">@lang('lang.Ledger_Details')</button>
                    </div>
                </div>


                {{--  --}}
                <div class="invoice" id="reloadDiv">
                    <div class="report pt-10 border-t border-gray ">
                        <div class="flex justify-between items-center">
                            <div class="flex gap-5 items-center">
                                <img src="{{ isset($company->logo) ? asset($company->logo) : asset('images/your-logo.jpg') }}"
                                    width="100" alt="">
                                <div>
                                    <h1 class="pb-3 text-red-600 text-3xl font-bold">
                                        {{ $company->name ?? 'The Web Concept' }}</h1>
                                    <p class="ps-1">PH NO: {{ $company->phone_no ?? '123 456 789' }}</p>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <h2 class="pb-2.5 font-bold">Account Name: <span class="font-light ps-3"
                                            id=accountName>
                                            Waheed</span></h2>
                                    <h2 class="pb-2.5 font-bold">Phone No: <span class="font-light ps-3"
                                            id="phone"></span>
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
                        type="button" id="printButton">
                        <div id="text">
                            @lang('lang.Print_Report')
                        </div>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')

<script>
    document.getElementById('printButton').onclick = function() {
        window.print();
    };
    $(document).ready(function() {
        $('#ledgerDataForm').submit(function(e) {
            $("#reloadDiv").load(" #reloadDiv > *");

            e.preventDefault();
            var formData = $(this).serialize();
            $customerId = $('#customer_account').val();
            $fromData = $('#from_date').val();
            $toDate = $('#to_date').val();


            var totalDebits = $('#totalDebits');
            var totalCredits = $('#totalCredits');
            var closingBalance = $('#closingBalance');

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
                    let user = response.user;
                    $('#accountName').text(user.name)
                    $('#phone').text(user.phone)
                    //
                    let transactions = response.data;
                    let newRows = '';
                    let tDebits = 0;
                    var tCredits = 0;
                    console.log(response);
                    transactions.forEach(function(transaction) {

                        let debit = parseFloat(transaction.debit) || 0;
                        let credit = parseFloat(transaction.credit) || 0;
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
                    $('#closingBalance ').text(tDebits - tCredits);

                },

            })

        })

    })
</script>

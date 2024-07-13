@include('layouts.header')
@include('layouts.nav')
<div class="md:mx-4 mt-12">

    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Request_Invoice')</h3>
                <div>

                    <button data-modal-target="addInvoiceModal" data-modal-toggle="addInvoiceModal"
                        class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                        @lang('lang.Add_Request')</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="datatable">
                    <thead class="py-1 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">@lang('lang.STN')</th>
                            <th class="whitespace-nowrap">@lang('lang.Invoice_No')</th>
                            <th class="whitespace-nowrap">@lang('lang.Amount')</th>
                            <th class="whitespace-nowrap">@lang('lang.Currency')</th>
                            <th class="whitespace-nowrap">@lang('lang.Payment_Method')</th>
                            <th class="whitespace-nowrap">@lang('lang.Website')</th>
                            <th class="whitespace-nowrap">@lang('lang.Status')</th>
                            <th class="whitespace-nowrap">@lang('lang.User')</th>
                            <th class="flex  justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($data as $data)
                            <tr>
                                <input type="hidden" value="{{ $data->id }}"
                                    id="invoice_id_{{ $loop->iteration }}">
                                <input type="hidden" value="{{ $data->user_id }}" id="user_id_{{ $loop->iteration }}">
                                <input type="hidden" value="{{ $data->transaction_id }}"
                                    id="transaction_id_{{ $loop->iteration }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->invoice_no }}</td>
                                <td>{{ $data->amount }}</td>
                                <td>{{ $data->currency }}</td>
                                <td>{{ $data->payment_method }}</td>
                                <td><a target="_blank" href="{{ $data->website }}"
                                        class="text-blue-600">{{ $data->website }}</a></td>
                                <td>
                                    @php
                                        $bgColorClass = '';
                                        switch ($data->status) {
                                            case 'pending':
                                                $bgColorClass = 'bg-red-500';
                                                break;
                                            case 'approved':
                                                $bgColorClass = 'bg-blue-800';
                                                break;

                                            case 'confirmed':
                                                $bgColorClass = 'bg-green-500';
                                                break;

                                            default:
                                                $bgColorClass = 'bg-red-600';
                                                break;
                                        }
                                    @endphp
                                    <button
                                        class="p-1 rounded-md  capitalize  {{ $bgColorClass }} text-white font-bold">
                                        {{ $data->status }}</button>
                                </td>
                                <td>{{ $data->user->name }}</td>

                                <td>
                                    <div class="flex gap-5 items-center justify-center">


                                        <button id="dropdownDefaultButton{{ $loop->iteration }}"
                                            data-dropdown-toggle="dropdown{{ $loop->iteration }}"
                                            class="text-white bg-secondary font-bold rounded-lg px-5 py-2.5 text-center inline-flex items-center "
                                            type="button">@lang('lang.Select_Action') <svg class="w-2.5 h-2.5 ms-3"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown menu -->
                                        <div id="dropdown{{ $loop->iteration }}"
                                            class="z-10 hidden absolute top-1 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="dropdownDefaultButton{{ $loop->iteration }}">
                                                <li class="py-1">
                                                    <a class="w-[42px] flex items-center gap-3"
                                                        href="../updateInvoice/{{ $data->id }}"><img width="38px"
                                                            src="{{ asset('images/icons/edit.svg') }}"
                                                            alt="update">@lang('lang.Edit')</a>
                                                </li>
                                                <li class="py-1 ">
                                                    <a class="w-[42px] flex items-center gap-3"
                                                        href="../deleteInvoice/{{ $data->id }}"> <img
                                                            width="38px"
                                                            src="{{ asset('images/icons/delete-green.svg') }}"
                                                            alt="update">@lang('lang.Delete')</a>
                                                </li>
                                                {{-- @if (session('user_det')['role'] == 'admin') --}}
                                                <li class="py-1 text-black updateStatusBtn"
                                                    updateId="{{ $data->id }}s">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="bg-secondary w-9 text-white p-1.5 rounded-full flex items-center gap-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 512 512" fill="white">
                                                                <path
                                                                    d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H352c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V80c0-17.7-14.3-32-32-32s-32 14.3-32 32v35.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V432c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H160c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z" />
                                                            </svg>
                                                        </div>
                                                        <button class="ChangeStatusBtn" invoiceId="{{ $data->id }}"
                                                            transactionId="{{ $data->transaction_id }}"
                                                            data-modal-target="changeStatus"
                                                            data-modal-toggle="changeStatus"
                                                            onclick="getId({{ $loop->iteration }})">
                                                            @lang('lang.Change_Status') </button>
                                                    </div>
                                                </li>
                                                {{-- @endif --}}
                                            </ul>
                                        </div>


                                    </div>
                                </td>
                                {{-- <div class="flex gap-5 items-center justify-center"> --}}

                                {{-- <button data-modal-target="Updateproductmodal"
                                            data-modal-toggle="Updateproductmodal"
                                            class=" updateBtn cursor-pointer  w-[42px]"
                                            updateId="{{ $data->id }}"><img width="38px"
                                                src="{{ asset('images/icons/edit.svg') }}" alt="update"></button> --}}
                                {{-- <a class="w-[42px] md:w-full" href="../delProduct/{{ $data->id }}"><img
                                                width="38px" src="{{ asset('images/icons/delete.svg') }}"
                                                alt="update"></button></a> --}}
                                {{-- <button data-modal-target="deleteData" data-modal-toggle="deleteData"
                                            class="delButton" delId="{{ $data->id }}">
                                            <img width="38px" src="{{ asset('images/icons/delete.svg') }}"
                                                alt="delete" class="cursor-pointer">
                                        </button> --}}
                                {{-- </div> --}}

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>






<div id="addInvoiceModal" data-modal-backdrop="static"
    class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
    <div class="relative p-4 w-full   max-w-6xl max-h-full ">
        @if (isset($Invoicedata))
            <form action="../updateInvoiceForm/{{ $Invoicedata->id }}" method="post" enctype="multipart/form-data">
            @else
                <form action="{{ route('requestInvoice') }}" method="post" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
            <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-xl font-semibold                     {{-- <select class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="payment_method" id="payment_method">
                        <option value="payoneer">@lang('lang.Payoneer')</option>
                        <option value="paypal">@lang('lang.PayPal')</option>
                    </select> --}}text-white ">
                    @lang('lang.Request_Invoice')
                </h3>
                <button type="button"
                    class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                    data-modal-hide="addInvoiceModal">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>


            <div class="grid md:grid-cols-3 gap-6 mx-6 my-6">
                <div>
                    <label class="text-[14px] font-normal" for="invoice_no">@lang('lang.Invoice_No')</label>
                    <input type="number" min="0" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="invoice_no" id="invoice_no" placeholder=" @lang('lang.Invoice_No')"
                        value="{{ $Invoicedata->invoice_no ?? '' }}">
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="amount">@lang('lang.Amount')</label>
                    <input type="number" min="0" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="amount" id="amount" placeholder=" @lang('lang.Amount_Here')"
                        value="{{ $Invoicedata->amount ?? '' }}">
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="currency">@lang('lang.Currency')</label>
                    <input list="browsers" name="currency" id="currency"
                        class="w-full border border-[#DEE2E6] placeholder:ps-2 rounded-[4px] focus:border-primary focus:border ps-2  h-[40px] text-[14px]"
                        placeholder="@lang('lang.Currency')" value="{{ $Invoicedata->currency ?? '' }}">

                    <datalist id="browsers">
                        <option value="pkr">

                    </datalist>
                </div>
            </div>
            <div class="grid md:grid-cols-3 gap-6 mx-6 my-6">
                <div>
                    <label class="text-[14px] font-normal" for="payment_method">@lang('lang.Payment_Method')</label>
                    <input list="currencies" name="payment_method" id="payment_method"
                        class="w-full border border-[#DEE2E6] placeholder:ps-2 rounded-[4px] focus:border-primary focus:border ps-2  h-[40px] text-[14px]"
                        placeholder="@lang('lang.Currency')" value="{{ $Invoicedata->payment_method ?? '' }}">
                    <datalist id="currencies">
                    </datalist>
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="website">@lang('lang.Website')</label>
                    <input type="text" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="website" id="website" placeholder=" @lang('lang.Website_URL_Here')"
                        value="{{ $Invoicedata->website ?? '' }}">

                </div>

            </div>
            <div class="grid md:grid-cols-3 gap-6 mx-6 my-6">
                <div>
                    <label class="text-[14px] font-normal" for="cust_name">@lang('lang.Customer_Name')</label>
                    <input type="text"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="cust_name" id="cust_name" placeholder=" @lang('lang.Customer_Name_Here')"
                        value=" {{ $Invoicedata->cust_name ?? '' }}" required>

                </div>
                <div>
                    <label class="text-[14px] font-normal" for="customer_email">@lang('lang.Customer_Email')</label>
                    <input type="email" min="1"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="cust_email" id="customer_email" placeholder=" @lang('lang.Customer_Email_Here')"
                        value=" {{ $Invoicedata->cust_email ?? '' }}" required>

                </div>
                <div>
                    <label class="text-[14px] font-normal" for="customer_phone_no">@lang('lang.Customer_Phone_No')</label>
                    <input type="number" min="1"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="cust_phone_no" id="customer_phone_no" placeholder=" @lang('lang.Customer_Phone_No')"
                        value="{{ $Invoicedata->cust_phone_no ?? '' }}" required>

                </div>

            </div>

            <div class="mx-6 my-4">
                <label class="text-[14px] font-normal" for="Description">@lang('lang.Description')</label>
                <textarea class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[120px] text-[14px]"
                    name="description" id="Description" required>{{ $Invoicedata->description ?? '' }}</textarea>

            </div>



            <div class="flex justify-end ">
                <button type="submit"
                    class="bg-primary text-white py-2 px-6 my-4 rounded-[4px]  mx-6 uaddBtn  font-semibold ">
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
                        @lang(isset($Invoicedata) ? 'lang.Update' : 'lang.Save')
                    </div>

                </button>
            </div>
        </div>
        </form>
        <div>

        </div>

    </div>
</div>


<div id="changeStatus" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative p-4 w-full   max-w-2xl max-h-full ">
        {{-- <form action="../changeVerStatus/5" method="post" enctype="multipart/form-data"> --}}
        <form action="" id="postId" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="updateid">

            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Change_Status')
                    </h3>
                    <button type="button"
                        class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                        data-modal-hide="changeStatus">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <input type="hidden" name="invoice_id" value="" id="showInvoiceId">
                <input type="hidden" name="transaction_id" value="" id="showTransactionId">
                <input type="hidden" name="user_id" value="" id="showUserId">
                <div class="grid md:grid-cols-2 gap-6 mx-6 mt-6">
                    <div class="pt-0.5">
                        <label class="text-[14px] font-normal" for="verification">@lang('lang.Status')</label>
                        <select class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[40px] text-[14px]"
                            name="status_update" id="verification" required onchange="show()">
                            <option selected disabled>@lang('lang.Change_Status')</option>
                            <option value="pending">@lang('lang.Pending')</option>
                            <option value="approved">@lang('lang.Approved')</option>
                            <option value="processing">@lang('lang.Processing')</option>
                        </select>
                    </div>

                    <div id="manageAmount" class="flex gap-3">
                        <div>
                            <label class="text-[14px] font-normal" for="total_amount">@lang('lang.Total_Amount')</label>
                            <input type="number" min="0"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[40px] text-[14px]"
                                name="total_amount" id="total_amount" placeholder=" @lang('lang.Total_Amount')">
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="payable_amount">@lang('lang.Payable_Amount')</label>
                            <input type="number" min="0"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[40px] text-[14px]"
                                name="payable_amount" id="payable_amount" placeholder=" @lang('lang.Payable_Amount')">
                        </div>
                    </div>



                </div>
                <div class="mt-3 mx-6">
                    <label class="text-[14px] font-normal" for="note">@lang('lang.Add_Note')</label>
                    <textarea name="note" class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[80px] text-[14px]"
                        id="note" placeholder="@lang('lang.Note_Here')" required></textarea>
                </div>
                <div class="flex justify-end ">
                    <button class="bg-primary text-white py-2 px-6 my-4 rounded-[4px]  mx-6 uaddBtn  font-semibold "
                        id="AaddBtn">
                        <div class=" text-center hidden" id="Aspinner">
                            <svg aria-hidden="true"
                                class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-primary"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d=" M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0
                        50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144
                        50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186
                        50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144
                        50.5908Z" fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                        <div id="Atext">
                            @lang('lang.Update')
                        </div>

                    </button>
                </div>
            </div>
        </form>
        <div>

        </div>

    </div>
</div>
</div>
@include('layouts.footer')

@if (isset($Invoicedata))
    <script>
        $(document).ready(function() {
            $('#addInvoiceModal').removeClass("hidden");

        });
    </script>
@endif
<script>
    $(document).ready(function() {
        $('.ChangeStatusBtn').click(function() {
            var invoiceId = $(this).attr('invoiceId');
            var transId = $(this).attr('transactionId');
            var transactionUrl = "../getInvoiceTransData/" + transId;
            var url = "../getInvoiceStatus/" + invoiceId;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    if (response.status == "approved") {
                        $.ajax({
                            type: "GET",
                            url: transactionUrl,
                            success: function(response) {
                                console.log();

                                $('#verification').val("approved").trigger(
                                    'change');
                                $('#total_amount').val(response.invouceAmout)
                                $('#payable_amount').val(response.data.credit);
                                $('#note').val(response.data
                                    .transaction_remarks)
                                var updateUrl = "../updateTransStatus/" +
                                    transId
                                $('#postId').attr('action', updateUrl);
                            }
                        });
                    }
                }


            });

        })

    })


    let verification = document.getElementById("verification");
    let manageAmount = document.getElementById("manageAmount");


    manageAmount.style.display = "none";

    function show() {
        if (verification.value === 'approved') {
            manageAmount.style.display = "flex";
        } else {
            manageAmount.style.display = "none";
        }
    }

    function getId(num) {


        let invoice_id = document.getElementById("invoice_id_" + num);
        let user_id = document.getElementById("user_id_" + num);
        let transaction_id = document.getElementById("transaction_id_" + num);

        document.getElementById("showInvoiceId").value = invoice_id.value;
        document.getElementById("showUserId").value = user_id.value;
        document.getElementById("showTransactionId").value = transaction_id.value;
        let postId = document.getElementById("postId");

        postId.setAttribute("action", "../addTransaction/" + invoice_id.value);
    }
</script>

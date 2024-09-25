@include('layouts.header')
@include('layouts.nav')
<div class="md:mx-4 mt-12">

    <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Request_Invoice')</h3>
    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <div>
                    <form id="filterForm">
                        <input type="hidden" value="{{ @$_GET['type'] }}" name="type">
                        <div class="flex gap-2">

                            <div>
                                @if (session('user_det')['role'] == 'admin')
                                    <label class="text-[14px] font-normal" for="filter">@lang('lang.Filter_by_User')</label>
                                    <select name="filter" id="filter">
                                        <option disabled>@lang('lang.Select_User')</option>
                                        <option {{ request('filter') == 'All' ? 'selected' : '' }} value="All">
                                            @lang('lang.All')</option>

                                        @foreach ($users as $user)
                                            <option {{ request('filter') == $user->id ? 'selected' : '' }}
                                                value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach

                                    </select>
                                @endif
                            </div>
                            <div>
                                <label class="text-[14px] font-normal" for="filterStatus">@lang('lang.Status')</label>
                                <select name="status" id="filterStatus">
                                    <option selected disabled>@lang('lang.Select_Status')</option>
                                    <option {{ request('status') == 'All' ? 'selected' : '' }} value="All">
                                        @lang('lang.All')</option>
                                    <option {{ request('status') == 'pending' ? 'selected' : '' }} value="pending">
                                        @lang('lang.Pending')</option>
                                    <option {{ request('status') == 'processing' ? 'selected' : '' }}
                                        value="processing">
                                        @lang('lang.Processing')</option>
                                    <option {{ request('status') == 'approved' ? 'selected' : '' }} value="approved">
                                        @lang('lang.Approved')</option>
                                </select>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="flex gap-4 items-center">
                    <div class="flex gap-4 items-center">
                        <div class="flex items-center ">
                            <input id="sending" type="radio" value="" name="default-radio"
                                {{ @$_GET['type'] == 'sending' ? 'checked' : '' }}
                                class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="sending"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sending
                                Invoice</label>
                        </div>
                        <div class="flex items-center ">
                            <input id="request" type="radio" value="" name="default-radio"
                                {{ @$_GET['type'] == 'sending' ? '' : 'checked' }}
                                class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="request"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Request
                                Invoice</label>
                        </div>
                    </div>
                    <button data-modal-target="sendInvoiceModal" data-modal-toggle="sendInvoiceModal"
                        class="bg-secondary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                        @lang('lang.Sending_Invoice')</button>

                    <button data-modal-target="addInvoiceModal" data-modal-toggle="addInvoiceModal"
                        class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                        @lang('lang.Add_Request')</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                @if (@$_GET['type'] == 'sending')
                    <table id="datatable">
                        <thead class="py-1 bg-primary text-white">
                            <tr>
                                <th class="whitespace-nowrap text-sm">@lang('lang.STN')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Invoice_No')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Sending_Date')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Amount')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Payment_Method')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Website')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Invoice_Url')</th>
                                <th class="whitespace-nowrap text-sm"> @lang('lang.Pkr_Amount')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Bank_Name')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Transaction_id')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Status')</th>
                                <th class="flex  justify-center text-sm">@lang('lang.Action')</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($sendInvoice as $Invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $Invoice->invoice_no }}</td>
                                    <td>{{ $Invoice->sending_date }}</td>
                                    <td>{{ $Invoice->amount }}</td>
                                    <td>{{ $Invoice->payment_method }}</td>
                                    <td><a href="{{ $Invoice->website }}" target="_blank" class="text-blue-600"></a>
                                    </td>
                                    <td><a href="{{ $Invoice->invoice_url }}" target="_blank"
                                            class="text-blue-600">{{ $Invoice->invoice_url }}</a></td>
                                    <td>{{ $Invoice->pkr_amount }}</td>
                                    <td>{{ $Invoice->bank_name }}</td>
                                    <td>{{ $Invoice->Transaction_id }}</td>
                                    <td> <button
                                            class="p-1 rounded-md  capitalize  {{ $Invoice->status == 'pending' ? 'bg-red-600' : 'bg-green-600' }} text-white font-bold text-md">
                                            {{ $Invoice->status }}</button></td>
                                    <td>
                                        <div class="flex gap-3 items-center justify-center">

                                            <button data-modal-target="Updateproductmodal"
                                                data-modal-toggle="Updateproductmodal"
                                                class=" updateBtn cursor-pointer  w-[42px]"
                                                updateId="{{ $Invoice->id }}"><svg width="36" height="36"
                                                    viewBox="0 0 36 36" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle opacity="0.1" cx="18" cy="18" r="18"
                                                        fill="#233A85" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.1637 23.6197L22.3141 15.666C22.6484 15.2371 22.7673 14.7412 22.6558 14.2363C22.5593 13.7773 22.277 13.3408 21.8536 13.0097L20.8211 12.1895C19.9223 11.4747 18.8081 11.5499 18.1693 12.3701L17.4784 13.2663C17.3893 13.3785 17.4116 13.544 17.523 13.6343C17.523 13.6343 19.2686 15.0339 19.3058 15.064C19.4246 15.1769 19.5137 15.3274 19.536 15.508C19.5732 15.8616 19.328 16.1927 18.9641 16.2379C18.7932 16.2605 18.6298 16.2078 18.511 16.11L16.6762 14.6502C16.5871 14.5832 16.4534 14.5975 16.3791 14.6878L12.0188 20.3314C11.7365 20.6851 11.64 21.1441 11.7365 21.588L12.2936 24.0035C12.3233 24.1314 12.4348 24.2217 12.5685 24.2217L15.0197 24.1916C15.4654 24.1841 15.8814 23.9809 16.1637 23.6197ZM19.5957 22.8676H23.5928C23.9828 22.8676 24.2999 23.1889 24.2999 23.5839C24.2999 23.9797 23.9828 24.3003 23.5928 24.3003H19.5957C19.2058 24.3003 18.8886 23.9797 18.8886 23.5839C18.8886 23.1889 19.2058 22.8676 19.5957 22.8676Z"
                                                        fill="#233A85" />
                                                </svg>
                                            </button>
                                            <a class="w-[42px] md:w-full" href="../delProduct/{{ $Invoice->id }}"><svg
                                                    width="36" height="36" viewBox="0 0 36 36" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle opacity="0.1" cx="18" cy="18" r="18"
                                                        fill="#DF6F79" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M23.4905 13.7433C23.7356 13.7433 23.9396 13.9468 23.9396 14.2057V14.4451C23.9396 14.6977 23.7356 14.9075 23.4905 14.9075H13.0493C12.8036 14.9075 12.5996 14.6977 12.5996 14.4451V14.2057C12.5996 13.9468 12.8036 13.7433 13.0493 13.7433H14.8862C15.2594 13.7433 15.5841 13.478 15.6681 13.1038L15.7642 12.6742C15.9137 12.0889 16.4058 11.7002 16.9688 11.7002H19.5704C20.1273 11.7002 20.6249 12.0889 20.7688 12.6433L20.8718 13.1032C20.9551 13.478 21.2798 13.7433 21.6536 13.7433H23.4905ZM22.5573 22.4946C22.7491 20.7073 23.0849 16.4611 23.0849 16.4183C23.0971 16.2885 23.0548 16.1656 22.9709 16.0667C22.8808 15.9741 22.7669 15.9193 22.6412 15.9193H13.9028C13.7766 15.9193 13.6565 15.9741 13.5732 16.0667C13.4886 16.1656 13.447 16.2885 13.4531 16.4183C13.4542 16.4261 13.4663 16.5757 13.4864 16.8258C13.5759 17.9366 13.8251 21.0305 13.9861 22.4946C14.1001 23.5731 14.8078 24.251 15.8328 24.2756C16.6238 24.2938 17.4387 24.3001 18.272 24.3001C19.0569 24.3001 19.854 24.2938 20.6696 24.2756C21.7302 24.2573 22.4372 23.5914 22.5573 22.4946Z"
                                                        fill="#D11A2A" />
                                                </svg>
                                            </a>

                                            <button data-modal-target="changeSendingStatus"
                                                data-modal-toggle="changeSendingStatus" class="ChangeStatusButton"
                                                sendingId="{{ $Invoice->id }}">
                                                <div
                                                    class="bg-primary w-9 text-white p-1.5 rounded-full flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        fill="white">
                                                        <path
                                                            d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H352c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V80c0-17.7-14.3-32-32-32s-32 14.3-32 32v35.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V432c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H160c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @else
                    <table id="datatable">
                        <thead class="py-1 bg-primary text-white">
                            <tr>
                                <th class="whitespace-nowrap text-sm">@lang('lang.STN')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.paypal_Invoice_Id')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Invoice_Url')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Amount')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Received/Payable')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Currency')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Payment_Method')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Website')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Customer_Name')</th>
                                <th class="whitespace-nowrap text-sm"> @lang('lang.Email_Phone')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Status')</th>
                                <th class="whitespace-nowrap text-sm">@lang('lang.Add_From')</th>
                                <th class="flex  justify-center text-sm">@lang('lang.Action')</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($data as $data)
                                <tr>
                                    <input type="hidden" value="{{ $data->id }}"
                                        id="invoice_id_{{ $loop->iteration }}">
                                    <input type="hidden" value="{{ $data->user_id }}"
                                        id="user_id_{{ $loop->iteration }}">
                                    <input type="hidden" value="{{ $data->transaction_id }}"
                                        id="transaction_id_{{ $loop->iteration }}">
                                    <td class="text-sm">{{ $loop->iteration }}</td>
                                    <td class="text-sm">{{ $data->paypal_no }}</td>
                                    <td class="text-sm"><a target="_blank" href="{{ $data->invoice_url }}"
                                            class="text-blue-600">{{ $data->invoice_url }}</a></td>
                                    <td class="text-sm">{{ $data->amount }}</td>
                                    <td class="text-sm"> {{ $data->received_amount }} <br> <span class="border-t-2">
                                            {{ $data->payable_amount }}</span>
                                    </td>
                                    <td class="text-sm">{{ $data->currency }}</td>
                                    <td class="text-sm">{{ $data->payment_method }}</td>
                                    <td class="text-sm"><a target="_blank" href="{{ $data->website }}"
                                            class="text-blue-600">{{ $data->website }}</a></td>
                                    <td class="text-sm">{{ $data->cust_name }}</td>
                                    <td class="text-sm"><a href="tel:{{ $data->cust_phone_no }}"
                                            class="text-blue-600">{{ $data->cust_phone_no }}</a> <br>
                                        <a href="mailto:{{ $data->cust_email }}"
                                            class="text-blue-500 mt-1">{{ $data->cust_email }}</a>
                                    </td>
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
                                                case 'processing':
                                                    $bgColorClass = 'bg-purple-900';
                                                    break;

                                                default:
                                                    $bgColorClass = 'bg-red-600';
                                                    break;
                                            }
                                        @endphp
                                        <button
                                            class="p-1 rounded-md  capitalize  {{ $bgColorClass }} text-white font-bold text-md">
                                            {{ $data->status }}</button>
                                    </td>
                                    <td class="text-sm">{{ $data->user->name }}</td>

                                    <td>
                                        @if (session('user_det')['role'] == 'admin' || (session('user_det')['role'] !== 'admin' && $data->status == 'pending'))
                                            <div class="flex gap-5 items-center justify-center">


                                                <button id="dropdownDefaultButton{{ $loop->iteration }}"
                                                    data-dropdown-toggle="dropdown{{ $loop->iteration }}"
                                                    class="text-white bg-secondary font-bold rounded-lg px-5 py-2.5 text-center inline-flex items-center "
                                                    type="button">@lang('lang.Action') <svg class="w-2.5 h-2.5 ms-3"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 10 6">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 4 4 4-4" />
                                                    </svg>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdown{{ $loop->iteration }}"
                                                    class="z-10 hidden absolute top-1 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                        aria-labelledby="dropdownDefaultButton{{ $loop->iteration }}">
                                                        <li class="py-1">
                                                            <a class="w-[42px] flex items-center gap-3"
                                                                href="../updateInvoice/{{ $data->id }}"><img
                                                                    width="38px"
                                                                    src="{{ asset('images/icons/update.svg') }}"
                                                                    alt="update">@lang('lang.Edit')</a>
                                                        </li>
                                                        <li class="py-1 ">
                                                            <a class="w-[42px] flex items-center gap-3"
                                                                href="../deleteInvoice/{{ $data->id }}"> <img
                                                                    width="38px"
                                                                    src="{{ asset('images/icons/delete.svg') }}"
                                                                    alt="update">@lang('lang.Delete')</a>
                                                        </li>
                                                        <li class="py-1 text-black viewSite">
                                                            <button
                                                                class="cursor-pointer viewBtn  flex gap-3 items-center"
                                                                invoiceId="{{ $data->id }}"><img width="38px"
                                                                    src="{{ asset('images/icons/view.svg') }}"
                                                                    alt="View">@lang('lang.Site_Details')</button>
                                                        </li>
                                                        @if (session('user_det')['role'] == 'admin')
                                                            <li class="py-1 text-black updateStatusBtn"
                                                                updateId="{{ $data->id }}s">
                                                                <div class="flex items-center gap-3">
                                                                    <div
                                                                        class="bg-primary w-9 text-white p-1.5 rounded-full flex items-center gap-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 512 512" fill="white">
                                                                            <path
                                                                                d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H352c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V80c0-17.7-14.3-32-32-32s-32 14.3-32 32v35.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V432c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H160c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z" />
                                                                        </svg>
                                                                    </div>
                                                                    <button class="ChangeStatusBtn"
                                                                        invoiceId="{{ $data->id }}"
                                                                        transactionId="{{ $data->transaction_id }}"
                                                                        data-modal-target="changeStatus"
                                                                        data-modal-toggle="changeStatus"
                                                                        onclick="getId({{ $loop->iteration }})">
                                                                        @lang('lang.Change_Status') </button>
                                                                </div>
                                                            </li>
                                                        @endif

                                                    </ul>
                                                </div>


                                            </div>
                                        @endif
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
                @endif
            </div>

        </div>
    </div>
</div>
{{-- ============ modal  =========== --}}
<div id="changeSendingStatus" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="fixed inset-0 transition-opacity">
        <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
    </div>
    <div class="relative p-4 w-full   max-w-2xl max-h-full ">
        <form id="SendingStatusForm" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="statusUpdateId">
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Update_Status')
                    </h3>
                    <button type="button"
                        class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                        data-modal-hide="changeSendingStatus">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class=" mx-6 my-6">
                    <div class="">
                        <label class="text-[14px] font-normal" for="Status">@lang('lang.Status')</label>
                        <select
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="status" id="Status">
                            <option selected disabled>@lang('lang.Select_Status')</option>
                            <option value="pending">@lang('lang.Pending')</option>
                            <option value="approved">@lang('lang.Approved')</option>
                        </select>

                    </div>

                </div>
                <div class="flex justify-end ">
                    <button class="bg-primary text-white py-2 px-6 my-4 rounded-[4px]  mx-6 uaddBtn  font-semibold "
                        id="saddBtn">
                        <div class=" text-center hidden" id="sspinner">
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
                        <div id="stext">
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



<div id="sendInvoiceModal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="fixed inset-0 transition-opacity">
        <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
    </div>
    <div class="relative p-4 w-full   max-w-6xl max-h-full ">
        @if (isset($Invoicedata))
            <form action="../updateInvoiceForm/{{ $Invoicedata->id }}" method="post" enctype="multipart/form-data">
            @else
                <form action="../addSendInvoice" method="post" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
            <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-xl font-semibold text-white ">
                    @lang('lang.Sending_Invoice')
                </h3>
                <button type="button"
                    class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                    data-modal-hide="sendInvoiceModal">
                    @if (isset($Invoicedata))
                        <a href="../requestInvoice">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </a>
                    @else
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    @endif
                </button>
            </div>


            <div class="flex gap-6 mx-6 my-6 ">
                <div class="flex gap-2">
                    <div>
                        <label class="text-[14px] font-normal" for="invoice_no">@lang('lang.Invoice_No')</label>
                        <input type="number" min="0"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="invoice_no" id="invoice_no" placeholder=" @lang('lang.invoice_no')"
                            value="{{ $Invoicedata->invoice_no ?? '' }}">
                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="Sending_Date">@lang('lang.Sending_Date')<span
                                class="text-red-700 text-xl">*</span></label>
                        <input type="date" min="0" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="sending_date" id="Sending_Date" value="{{ $Invoicedata->sending_date ?? '' }}">
                    </div>
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="amount">@lang('lang.Amount')<span
                            class="text-red-700 text-xl">*</span></label>
                    <input type="text" min="0" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="amount" id="amount" placeholder=" @lang('lang.Amount_Here')"
                        value="{{ $Invoicedata->amount ?? '' }}">
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="payment_method">@lang('lang.Payment_Method')<span
                            class="text-red-700 text-xl">*</span></label>
                    <select name="payment_method" id="sendingMethod">
                        <option value="paypal">@lang('lang.PayPal')</option>
                        <option value="payoneer">@lang('lang.Payoneer')</option>
                        <option value="local">@lang('lang.Local_Bank')</option>
                    </select>

                </div>

            </div>
            <div id="bankInfoFeilds">
                <div class="grid grid-cols-3 gap-6 mx-6">
                    {{-- <div>
                    <label class="text-[14px] font-normal" for="website">@lang('lang.Sending_Source')<span
                            class="text-red-700 text-xl">*</span></label>
                    <input type="text" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="website" id="sendingSource" placeholder=" @lang('lang.Sending_Source')"
                        value="{{ $Invoicedata->sending_source ?? '' }}">

                </div> --}}
                    <div>
                        <label class="text-[14px] font-normal" for="website">@lang('lang.PKR')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="pkr_amount" id="pkrAmount" placeholder=" @lang('lang.Pkr_Amount')"
                            value="{{ $Invoicedata->pkr_Amount ?? '' }}">

                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="website">@lang('lang.Bank_Name')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="bank_name" id="pkrAmount" placeholder=" @lang('lang.Pkr_Amount')"
                            value="{{ $Invoicedata->bank_name ?? '' }}">

                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="Transaction_id">@lang('lang.Transaction_id_bank_name')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="Transaction_id" id="Transaction_id" placeholder=" @lang('lang.Transaction_id_bank_name')"
                            value="{{ $Invoicedata->bank_name ?? '' }}">

                    </div>

                </div>
            </div>
            <div class="grid grid-cols-3 gap-6 mx-6
            ">
                <div>
                    <label class="text-[14px] font-normal" for="website">@lang('lang.Website')<span
                            class="text-red-700 text-xl">*</span></label>
                    <input type="text" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="website" id="website" placeholder=" @lang('lang.Website_URL_Here')"
                        value="{{ $Invoicedata->website ?? '' }}">

                </div>
                <div>
                    <label class="text-[14px] font-normal" for="invoiceUrl">@lang('lang.Invoice_Url')</label>
                    <input type="text"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="invoice_url" id="invoiceUrl" placeholder="@lang('lang.Invoice_Url')"
                        value="{{ $Invoicedata->invoice_url ?? '' }}">

                </div>
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

<div id="addInvoiceModal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="fixed inset-0 transition-opacity">
        <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
    </div>
    <div class="relative p-4 w-full   max-w-6xl max-h-full ">
        @if (isset($Invoicedata))
            <form action="../updateInvoiceForm/{{ $Invoicedata->id }}" method="post" enctype="multipart/form-data">
            @else
                <form action="{{ route('requestInvoice') }}" method="post" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
            <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-xl font-semibold text-white ">
                    @lang('lang.Request_Invoice')
                </h3>
                <button type="button"
                    class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                    data-modal-hide="addInvoiceModal">
                    @if (isset($Invoicedata))
                        <a href="../requestInvoice">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </a>
                    @else
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    @endif
                </button>
            </div>


            <div class="flex gap-6 mx-6 my-6 ">
                <div class="flex gap-2">
                    <div>
                        <label class="text-[14px] font-normal" for="invoice_no">@lang('lang.Invoice_No')<span
                                class="text-red-700 text-xl">*</span></label>
                        <input type="number" min="0" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="invoice_no" id="invoice_no" placeholder=" @lang('lang.Invoice_No')"
                            value="{{ $Invoicedata->invoice_no ?? '' }}">
                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="Sending_Date">@lang('lang.Sending_Date')<span
                                class="text-red-700 text-xl">*</span></label>
                        <input type="date" min="0" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="sending_date" id="Sending_Date" value="{{ $Invoicedata->sending_date ?? '' }}">
                    </div>
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="amount">@lang('lang.Amount')<span
                            class="text-red-700 text-xl">*</span></label>
                    <input type="number" min="0" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="amount" id="amount" placeholder=" @lang('lang.Amount_Here')"
                        value="{{ $Invoicedata->amount ?? '' }}">
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="curency">@lang('lang.Currency')<span
                            class="text-red-700 text-xl">*</span></label>
                    <input list="browsers" name="currency" id="currency"
                        class="w-full border border-[#DEE2E6] placeholder:ps-2 rounded-[4px] focus:border-primary focus:border ps-2  h-[40px] text-[14px]"
                        placeholder="@lang('lang.Currency')" value="{{ $Invoicedata->currency ?? '' }}">

                    <datalist id="browsers">
                        <option value="pkr">

                    </datalist>
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="payment_method">@lang('lang.Payment_Method')<span
                            class="text-red-700 text-xl">*</span></label>
                    <input list="currencies" name="payment_method" id="payment_method"
                        class="w-full border border-[#DEE2E6] placeholder:ps-2 rounded-[4px] focus:border-primary focus:border ps-2  h-[40px] text-[14px]"
                        placeholder="@lang('lang.Currency')" value="{{ $Invoicedata->payment_method ?? '' }}">
                    <datalist id="currencies">
                    </datalist>
                </div>

            </div>
            <div class="grid grid-cols-4 gap-6 mx-6 ">
                <div>
                    <label class="text-[14px] font-normal" for="website">@lang('lang.Website')<span
                            class="text-red-700 text-xl">*</span></label>
                    <input type="text" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="website" id="website" placeholder=" @lang('lang.Website_URL_Here')"
                        value="{{ $Invoicedata->website ?? '' }}">

                </div>
                <div>
                    <label class="text-[14px] font-normal" for="invoiceUrl">@lang('lang.Live_Link')<span
                            class="text-red-700 text-xl">*</span></label>
                    <input type="text"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="req_invoice_url" id="invoiceUrl" placeholder="@lang('lang.Live_Link')"
                        value="{{ $Invoicedata->invoice_url ?? '' }}" required>

                </div>
            </div>
            <div class="grid md:grid-cols-4 gap-6 mx-6 my-6">
                <div>
                    <label class="text-[14px] font-normal" for="clientSelect">@lang('lang.Client')<span
                            class="text-red-700 text-xl">*</span></label>
                    <select name="client" id="clientSelect" required>
                        <option selected disabled>@lang('lang.Select_Client')</option>
                        @lang('lang.All')</option>

                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                        @endforeach

                    </select>
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="cust_name">@lang('lang.Client_Name') <span
                            class="text-red-700 text-[12px]">(readonly)</span><span
                            class="text-red-700 text-xl">*</span></label>
                    <input type="text"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="cust_name" id="cust_name" placeholder=" @lang('lang.Client_Name_Here')"
                        value="{{ $Invoicedata->cust_name ?? '' }}" readonly required>

                </div>
                <div>
                    <label class="text-[14px] font-normal" for="customer_email">@lang('lang.Client_Email') <span
                            class="text-red-700 text-[12px]">(readonly)</span><span
                            class="text-red-700 text-xl">*</span></label>
                    <input type="email" min="1"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="cust_email" id="customer_email" placeholder=" @lang('lang.Client_Email_Here')"
                        value=" {{ $Invoicedata->cust_email ?? '' }}" readonly>

                </div>
                <div>
                    <label class="text-[14px] font-normal" for="customer_phone_no">@lang('lang.Client_Phone_No') <span
                            class="text-red-700 text-[12px]">(readonly)</span></label>
                    <input type="number" min="1"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="cust_phone_no" id="customer_phone_no" placeholder=" @lang('lang.Client_Phone_No_Here')"
                        value="{{ $Invoicedata->cust_phone_no ?? '' }}" readonly>

                </div>

            </div>

            <div class="mx-6 my-4">
                <label class="text-[14px] font-normal" for="Description">@lang('lang.Description')</label>
                <textarea class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[120px] text-[14px]"
                    name="description" id="Description" placeholder="@lang('lang.Description')">{{ $Invoicedata->description ?? '' }}</textarea>

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
    <div class="fixed inset-0 transition-opacity">
        <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
    </div>
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
                            <option value="processing">@lang('lang.Processing')</option>
                            <option value="approved">@lang('lang.Approved')</option>
                        </select>
                    </div>
                    <div id="hideInput">
                        <label class="text-[14px] font-normal" for="paypal_no">@lang('lang.paypal_Invoice_Id')</label>
                        <input type="number" min="0"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[40px] text-[14px]"
                            name="paypal_no" id="paypal_no" placeholder=" @lang('lang.paypal_No')">
                    </div>
                    <div class="col-span-2" id="hideInput2">
                        <label class="text-[14px] font-normal" for="Invoice_Url">@lang('lang.Invoice_Url')</label>
                        <input type="text" min="0"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[40px] text-[14px]"
                            name="invoice_url" id="Invoice_Url" placeholder=" @lang('lang.Invoice_Url')">
                    </div>
                    <div id="manageAmount" class="flex gap-3 col-span-2">
                        <div>
                            <label clasids="text-[14px] font-normal" for="total_amount">@lang('lang.Total_Amount')</label>
                            <input type="number" min="0"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[40px] text-[14px]"
                                name="total_amount" id="total_amount" placeholder=" @lang('lang.Total_Amount')">
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="Received_Amount">@lang('lang.Received_Amount')</label>
                            <input type="number" min="0"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[40px] text-[14px]"
                                name="received_amount" id="Received_Amount" placeholder=" @lang('lang.Received_Amount')">
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="payable_amount">@lang('lang.Payable_Amount')
                                (PKR)</label>
                            <input type="number" min="0"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[40px] text-[14px]"
                                name="payable_amount" id="payable_amount" placeholder=" @lang('lang.Payable_Amount')">
                        </div>
                    </div>



                </div>
                <div class="mt-3 mx-6">
                    <label class="text-[14px] font-normal" for="note">@lang('lang.Add_Note')</label>
                    <textarea name="note" class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary h-[80px] text-[14px]"
                        id="note" placeholder="@lang('lang.Note_Here')"></textarea>
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

<button data-modal-target="InvoiceShowModal" data-modal-toggle="InvoiceShowModal" class="hidden"></button>

<div id="InvoiceShowModal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="fixed inset-0 transition-opacity">
        <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
    </div>
    <div class="relative p-4 w-full   max-w-6xl max-h-full ">
        <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
            <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-xl font-semibold text-white ">
                    @lang('lang.Invoice_Details')
                </h3>
                <button type="button"
                    class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                    data-modal-hide="InvoiceShowModal">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <div class="flex justify-center items-center gap-5 flex-col py-4">
                <div>
                    <h1 class="text-center text-3xl text-secondary font-semibold">Invoice Details</h1>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h1 class="text-right font-semibold">@lang('lang.paypal_Invoice_Id')</h1>
                    </div>
                    <div>
                        <h1 id="paypalNo"></h1>

                    </div>
                </div>

                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h1 class="text-right font-semibold">@lang('lang.Invoice_Url')</h1>
                    </div>
                    <div>
                        <h1 id="InvoiceUrl"></h1>

                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h1 class="text-right font-semibold">@lang('lang.Amount')</h1>
                    </div>
                    <div>
                        <h1 id="Amount"></h1>

                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h1 class="text-right font-semibold">@lang('lang.Received/Payable')</h1>
                    </div>
                    <div>
                        <h1 id="recPayAmount"> </h1>

                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h1 class="text-right font-semibold">@lang('lang.Currency')</h1>
                    </div>
                    <div>
                        <h1 id="Currency"></h1>

                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h1 class="text-right font-semibold">@lang('lang.Website')</h1>
                    </div>
                    <div>
                        <h1 id="Website"></h1>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h1 class="text-right font-semibold">@lang('lang.Customer_Name')</h1>
                    </div>
                    <div>
                        <h1 id="customerName"></h1>

                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h1 class="text-right font-semibold">@lang('lang.Email_Phone')</h1>
                    </div>
                    <div id="emailPhone">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h1 class="text-right font-semibold">@lang('lang.Add_From')</h1>
                    </div>
                    <div id="addFrom">

                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h1 class="text-right font-semibold">@lang('lang.Status')</h1>
                    </div>
                    <div>
                        <h1 id="invoiceStatus"></h1>
                    </div>
                </div>

            </div>


        </div>


    </div>
</div>
@include('layouts.footer')

@if (isset($Invoicedata))
    <script>
        $(document).ready(function() {
            $('#addInvoiceModal').removeClass("hidden");
            $('#addInvoiceModal').addClass("flex");

        });
    </script>
@endif


<script>
    function dropdownrun() {

        // Select all dropdown buttons
        const dropdownButtons = document.querySelectorAll('[data-dropdown-toggle]');

        dropdownButtons.forEach(button => {
            // Get the target dropdown ID from the button's data attribute
            const dropdownId = button.getAttribute('data-dropdown-toggle');
            const dropdown = document.getElementById(dropdownId);

            // Add click event listener to the button
            button.addEventListener('click', function(event) {
                event.stopPropagation();
                // Toggle the visibility of the dropdown
                dropdown.classList.toggle('hidden');
            });

            // Add click event listener to the document to close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!dropdown.contains(event.target) && !button.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    }
    dropdownrun();
    $(document).ready(function() {

        function changeSts() {
            $('.ChangeStatusButton').click(function() {
                let id = $('#statusUpdateId').val($(this).attr('sendingId'));
                $('#changeSendingStatus').addClass('flex').removeClass('hidden');

            })
        }

        changeSts()

        $('#SendingStatusForm').submit(function() {
            let id = $('#statusUpdateId').val();
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "/changeSendingStatus/" + id,
                data: formData,
                dataType: "json",
                beforeSend: function() {
                    $('#sspinner').removeClass('hidden');
                    $('#stext').addClass('hidden');
                    $('#saddBtn').attr('disabled', true);
                },
                success: function(response) {
                    // Handle the success response here
                    if (response.success == true) {
                        $('#text').removeClass('hidden');
                        $('#spinner').addClass('hidden');

                        window.location.href = 'requestInvoice?type=sending';

                    } else if (response.success == false) {
                        Swal.fire(
                            'Warning!',
                            response.message,
                            'warning'
                        )
                    }
                },
                error: function(jqXHR) {

                    let response = JSON.parse(jqXHR.responseText);

                    Swal.fire(
                        'Warning!',
                        response.message,
                        'warning'
                    )
                    $('#stext').removeClass('hidden');
                    $('#sspinner').addClass('hidden');
                    $('#saddBtn').attr('disabled', false);
                }
            });

        })

        $('#sending').change(function() {
            if ($(this).is(':checked')) {
                // Redirect to the desired page
                window.location.href = '../requestInvoice?type=sending';
            }
        });
        $('#request').change(function() {
            if ($(this).is(':checked')) {
                // Redirect to the desired page
                window.location.href = '../requestInvoice';
            }
        });

        function viewDatafun() {


            $('.viewBtn').click(function() {
                $('#InvoiceShowModal').addClass('flex').removeClass('hidden');
                let invoiceId = $(this).attr('invoiceId');
                let url = "../viewInvoiceData/" + invoiceId;
                console.log(url);

                $.ajax({

                    type: "GET",
                    url: url,
                    success: function(response) {
                        $('#InvoiceShowModal').removeClass("hidden");
                        $('#InvoiceShowModal').addClass("flex");
                        console.log(response);
                        let data = response.data;
                        $('#paypalNo').text(data.paypal_no);
                        $('#InvoiceUrl').text(data.invoice_url);
                        $('#Amount').text(data.amount);
                        $('#recPayAmount').text(
                            (data.received_amount ? data.received_amount : 0) + "/" +
                            (data.payable_amount ? data.payable_amount : 0)
                        );

                        $('#Currency').text(data.currency);
                        $('#Website').text(data.website);
                        $('#customerName').text(data.cust_name);
                        $('#emailPhone').html(`<a href="tel:${data.cust_phone_no}"
                    class="text-blue-600">${data.cust_phone_no ? data.cust_phone_no : ''}</a> <br>
                    <a href="mailto:${data.cust_email}"
                    class="text-blue-500 mt-1">${data.cust_email ? data.cust_email : ''}</a>`);
                        $('#addFrom').text(data.user_id);
                        $('#invoiceStatus').text(data.status)


                    }
                })
            })
        }
        viewDatafun()

        $('#clientSelect').on('change select', function() {
            var clientId = $(this).val();
            $.ajax({
                type: "GET",
                url: "../getClientData/" + clientId,
                success: function(response) {
                    $('#cust_name').val(response.data.client_name);
                    $('#customer_email').val(response.data.client_email);
                    $('#customer_phone_no').val(response.data.client_contact);
                },


            });

            // Add your logic here based on the selected clientId
        });




        function changeStsFun() {

            $('.ChangeStatusBtn').click(function() {
                $('#changeStatus').addClass('flex').removeClass('hidden');
                var invoiceId = $(this).attr('invoiceId');
                var transId = $(this).attr('transactionId');
                var transactionUrl = "../getInvoiceTransData/" + transId;
                var url = "../getInvoiceStatus/" + invoiceId;
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        if (response.status == "approved" || response.status ==
                            "processing") {
                            let status = response.status;
                            $.ajax({
                                type: "GET",
                                url: transactionUrl,
                                success: function(response) {
                                    console.log(response.data);

                                    $('#verification').val(status)
                                        .trigger(
                                            'change');
                                    $('#total_amount').val(response
                                        .invouceAmout
                                        .total_amount)
                                    $('#payable_amount').val(response
                                        .data.credit);
                                    $('#Invoice_Url').val(response
                                        .invouceAmout
                                        .invoice_url);
                                    $('#paypal_no').val(response
                                        .invouceAmout
                                        .paypal_no);
                                    $('#Received_Amount').val(response
                                        .invouceAmout
                                        .received_Amount);
                                    $('#note').val(response.data
                                        .transaction_remarks)
                                    var updateUrl =
                                        "../updateTransStatus/" +
                                        transId
                                    $('#postId').attr('action',
                                        updateUrl);
                                }
                            });
                        }
                    }


                });

            })
        }
        changeStsFun()
        var table = $('#datatable').DataTable();
        table.on('draw', function() {
            changeStsFun()
            changeSts()
            viewDatafun()

        });

        $('#filter, #filterStatus').change(function() {
            $('#filterForm').submit();
        });




        $('#bankInfoFeilds').css('display', 'none');
        $('#sendingMethod').change(function() {
            let paymentMethod = $(this).val();
            if (paymentMethod == "local") {
                $('#bankInfoFeilds').css('display', 'block');

            } else {
                $('#bankInfoFeilds').css('display', 'none');

            }

        })
    })


    let verification = document.getElementById("verification");
    let manageAmount = document.getElementById("manageAmount");
    let Input = document.getElementById("hideInput");
    let Input2 = document.getElementById("hideInput2");


    manageAmount.style.display = "none";
    Input.style.display = "none";
    Input2.style.display = "none";

    function show() {
        if (verification.value === 'approved') {
            manageAmount.style.display = "flex";
            Input.style.display = "block";
            Input2.style.display = "block";
        } else if (verification.value === "processing") {

            Input.style.display = "block";
            Input2.style.display = "block";


        } else {
            manageAmount.style.display = "none";
            Input.style.display = "none";
            Input2.style.display = "none";
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

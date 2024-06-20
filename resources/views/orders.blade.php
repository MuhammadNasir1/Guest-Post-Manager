@include('layouts.header')
@include('layouts.nav')
<div class="md:mx-4 mt-12">


    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-between px-[20px] mb-3">
                <h3 class="text-[20px] text-black">@lang('lang.Order_List')</h3>
            </div>
            <div class="overflow-x-auto">
                <table id="datatable" class="overflow-scroll">
                    <thead class="py-6 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">@lang('lang.Order_Number')</th>
                            <th class="whitespace-nowrap">@lang('lang.Order_Date')</th>
                            <th class="whitespace-nowrap">@lang('lang.Order_From')</th>
                            <th class="whitespace-nowrap">@lang('lang.Customer_Name')</th>
                            <th class="whitespace-nowrap">@lang('lang.Customer_phone')</th>
                            <th class="whitespace-nowrap">@lang('lang.Amount')</th>
                            <th class="whitespace-nowrap">@lang('lang.Order_Status')</th>
                            <th class="flex justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $x => $data)
                            <tr class="pt-4">
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->order_date }}</td>
                                <td>{{ $data->order_from }}</td>
                                <td>{{ $data->customer_name }}</td>
                                <td>{{ $data->customer_phone }}</td>
                                <td>{{ $data->grand_total }}&euro;</td>
                                <td>


                                    @php
                                        $bgColorClass = '';
                                        switch ($data->order_status) {
                                            case 'pending':
                                                $bgColorClass = 'bg-red-500';
                                                break;
                                            case 'shipped':
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
                                    <button class="px-4 py-2 rounded-md   {{ $bgColorClass }} text-white font-bold">
                                        {{ $data->order_status }}</button>
                                </td>
                                <td>
                                    <div class="flex gap-5 items-center justify-center">


                                        <button id="dropdownDefaultButton{{ $x }}"
                                            data-dropdown-toggle="dropdown{{ $x }}"
                                            class="text-white bg-green-500 font-bold rounded-lg px-5 py-2.5 text-center inline-flex items-center "
                                            type="button">@lang('lang.Select_Action') <svg class="w-2.5 h-2.5 ms-3"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown menu -->
                                        <div id="dropdown{{ $x }}"
                                            class="z-10 hidden absolute top-1 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="dropdownDefaultButton{{ $x }}">
                                                <li class="py-1">
                                                    <a class="w-[42px] flex items-center gap-3"
                                                        href="../order/{{ $data->id }}"><img width="38px"
                                                            src="{{ asset('images/icons/edit.svg') }}"
                                                            alt="update">@lang('lang.Edit')</a>
                                                </li>
                                                <li class="py-1 ">
                                                    {{-- <a class="w-[42px] flex items-center gap-3"
                                                        href="../delOrder/{{ $data->id }}"> <img width="38px"
                                                            src="{{ asset('images/icons/delete-green.svg') }}"
                                                            alt="update">@lang('lang.Delete')</a> --}}
                                                    <button data-modal-target="deleteData"
                                                        data-modal-toggle="deleteData"
                                                        class="delButton items-center flex gap-3"
                                                        delId="{{ $data->id }}">
                                                        <img width="38px"
                                                            src="{{ asset('images/icons/delete-green.svg') }}"
                                                            alt="delete" class="cursor-pointer">
                                                        <p>@lang('lang.Delete')</p>
                                                    </button>
                                                </li>
                                                <li class="py-1">
                                                    <a href="../invoice/{{ $data->id }}"
                                                        class="flex items-center gap-3">
                                                        <div class="bg-primary w-9 rounded-full p-1.5 text-white">
                                                            <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" fill="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path fill-rule="evenodd"
                                                                    d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                        @lang('lang.Invoice')
                                                    </a>
                                                </li>
                                                <li class="py-1">
                                                    <a href="../gatepass/{{ $data->id }}"
                                                        class="flex items-center gap-3">
                                                        <div
                                                            class="bg-primary w-9 text-white p-1.5 rounded-full flex items-center gap-3">
                                                            <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" fill="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path fill-rule="evenodd"
                                                                    d="M11.403 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-6.403a3.01 3.01 0 0 1-1.743-1.612l-3.025 3.025A3 3 0 1 1 9.99 9.768l3.025-3.025A3.01 3.01 0 0 1 11.403 5Z"
                                                                    clip-rule="evenodd" />
                                                                <path fill-rule="evenodd"
                                                                    d="M13.232 4a1 1 0 0 1 1-1H20a1 1 0 0 1 1 1v5.768a1 1 0 1 1-2 0V6.414l-6.182 6.182a1 1 0 0 1-1.414-1.414L17.586 5h-3.354a1 1 0 0 1-1-1Z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                        @lang('lang.Gate_Pass')
                                                    </a>
                                                </li>
                                                <li class="py-1 text-black updateStatusBtn"
                                                    updateId="{{ $data->id }}">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="bg-primary w-9 text-white p-1.5 rounded-full flex items-center gap-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 512 512" fill="white">
                                                                <path
                                                                    d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H352c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V80c0-17.7-14.3-32-32-32s-32 14.3-32 32v35.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V432c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H160c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z" />
                                                            </svg>
                                                        </div>
                                                        <button updateId="{{ $data->id }}"
                                                            data-modal-target="changeStatus"
                                                            data-modal-toggle="changeStatus" class="">
                                                            @lang('lang.Change_Status') </button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        {{-- <a class="w-[42px] " href="../order/{{ $data->id }}"><img width="38px"
                                                src="{{ asset('images/icons/edit.svg') }}" alt="update"></a>
                                        <a class="w-[42px]" href="../delOrder/{{ $data->id }}"> <img width="38px"
                                                src="{{ asset('images/icons/delete.svg') }}" alt="update"></a>
                                        <a href="../invoice/{{ $data->id }}">
                                            <div class="bg-primary rounded-full p-1.5 text-white">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </a>
                                        <a href="../gatepass/{{ $data->id }}">
                                            <div class="bg-primary text-white p-1.5 rounded-full">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M11.403 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-6.403a3.01 3.01 0 0 1-1.743-1.612l-3.025 3.025A3 3 0 1 1 9.99 9.768l3.025-3.025A3.01 3.01 0 0 1 11.403 5Z"
                                                        clip-rule="evenodd" />
                                                    <path fill-rule="evenodd"
                                                        d="M13.232 4a1 1 0 0 1 1-1H20a1 1 0 0 1 1 1v5.768a1 1 0 1 1-2 0V6.414l-6.182 6.182a1 1 0 0 1-1.414-1.414L17.586 5h-3.354a1 1 0 0 1-1-1Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </a>
                                        <button updateId="{{ $data->id }}" data-modal-target="changeStatus"
                                            data-modal-toggle="changeStatus"
                                            class="px-4 py-2 rounded-md bg-orange-500 text-white font-bold updateStatusBtn">
                                            @lang('lang.Change_Status') </button> --}}
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

{{-- Delete Data Modal --}}
<div id="deleteData" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-   max-h-full ">
    <div class="relative p-4 w-full   max-w-lg max-h-full ">
        <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
            <div class="">

                <button type="button"
                    class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                    data-modal-hide="deleteData">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <div class=" mx-6 my-6 pt-5">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100px" class="mx-auto" viewBox="0 0 512 512">
                        <path
                            d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"
                            fill="red" />
                    </svg>
                    <h1 class="text-center pt-3 text-4xl">@lang('lang.Are_You_Sure')</h1>
                    <div class="flex  justify-center gap-5 mx-auto mt-5 pb-5">
                        <button data-modal-hide="deleteData" class="bg-primary px-7 py-3 text-white rounded-md">
                            @lang('lang.No')
                        </button>
                        <a class="" id="delLink" href="">

                            <button class=" bg-red-600 px-7 py-3 text-white rounded-md">
                                @lang('lang.Yes')
                            </button>
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <div>

    </div>

</div>

{{-- ============ modal  =========== --}}
<div id="changeStatus" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative p-4 w-full   max-w-2xl max-h-full ">
        <form id="OrderStatusData" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="update_id">
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Update_Status')
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
                <div class=" mx-6 my-6">
                    <div class="">
                        <label class="text-[14px] font-normal" for="Status">@lang('lang.Status')</label>
                        <select
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="order_status" id="Status">
                            <option selected disabled>@lang('lang.Select_Order_Status')</option>
                            <option value="pending">@lang('lang.Pending')</option>
                            <option value="confirmed">@lang('lang.Confirmed')</option>
                            <option value="shipped">@lang('lang.Shipped')</option>
                        </select>

                    </div>

                </div>
                <div class="flex justify-end ">
                    <button class="bg-primary text-white py-2 px-6 my-4 rounded-[4px]  mx-6 uaddBtn  font-semibold "
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


@include('layouts.footer')


<script>
    $(document).ready(function() {
        $('.delButton').click(function() {
            var id = $(this).attr('delId');
            $('#delLink').attr('href', '../delOrder/' + id);
            console.log(id);
        });
        $(document).ready(function() {
            $('.updateStatusBtn').click(function() {
                var id = $(this).attr('updateId');
                $('#update_id').val(id);
            });

            $("#OrderStatusData").submit(function(event) {
                var updateId = $('#update_id').val();
                var url = "../updateOrderStatus/" + updateId;
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#spinner').removeClass('hidden');
                        $('#text').addClass('hidden');
                        $('#addBtn').attr('disabled', true);
                    },
                    success: function(response) {
                        window.location.href = '../orders';

                    },
                    error: function(jqXHR) {
                        let response = JSON.parse(jqXHR.responseText);
                        console.log("error");
                        Swal.fire(
                            'Warning!',
                            response.message,
                            'warning'
                        );

                        $('#text').removeClass('hidden');
                        $('#spinner').addClass('hidden');
                        $('#addBtn').attr('disabled', false);
                    }
                });


            });
        });
    });
</script>

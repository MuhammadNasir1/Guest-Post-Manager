@include('layouts.header')
@include('layouts.nav')
<div class="md:mx-4 mt-12">

    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Customer_List')</h3>
                <div>

                    <button data-modal-target="addcustomermodal" data-modal-toggle="addcustomermodal"
                        class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                        @lang('lang.Add_Customer')</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="datatable">
                    <thead class="py-1 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">@lang('lang.STN')</th>
                            <th class="whitespace-nowrap">@lang('lang.Name')</th>
                            <th class="whitespace-nowrap">@lang('lang.Email')</th>
                            <th class="whitespace-nowrap">@lang('lang.Phone_No')</th>
                            <th class="whitespace-nowrap">@lang('lang.Role')</th>
                            <th class="whitespace-nowrap">@lang('lang.Verification')</th>
                            <th class="flex  justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $x => $data)
                            <tr class="pt-4">
                                <td>{{ $x + 1 }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->role }}</td>
                                <td> <button
                                        class="px-4 py-2 rounded-md  {{ $data->verification == 'pending' ? 'bg-red-600' : 'bg-green-700' }}  text-white font-bold">
                                        {{ $data->verification }}<button></td>
                                <td>
                                    <div class="flex gap-5 items-center justify-center">

                                        <button data-modal-target="updatecustomermodal"
                                            data-modal-toggle="updatecustomermodal"
                                            class=" updateBtn cursor-pointer  w-[42px]"
                                            updateId="{{ $data->id }}"><img width="38px"
                                                src="{{ asset('images/icons/edit.svg') }}" alt="update"></button>
                                        {{-- <a class="w-[42px]"  href="../delCustomer/{{ $data->id }}"><img
                                                width="38px" src="{{ asset('images/icons/delete.svg') }}"
                                                alt="update"></button></a> --}}
                                        <button data-modal-target="deleteData" data-modal-toggle="deleteData"
                                            class="delButton" delId="{{ $data->id }}">
                                            <img width="38px" src="{{ asset('images/icons/delete.svg') }}"
                                                alt="delete" class="cursor-pointer">
                                        </button>
                                        {{-- <button updateId="{{ $data->id }}" data-modal-target="changeStatus"
                                            data-modal-toggle="changeStatus" class="">
                                            @lang('lang.Change_Status') </button> --}}
                                        <button updateId="{{ $data->id }}" data-modal-target="changeStatus"
                                            data-modal-toggle="changeStatus"
                                            class="px-4 py-3 rounded-md  bg-primary  text-white font-bold updateVerBtn">
                                            @lang('lang.Change_Verfication')<button>
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



{{-- ============ update  customer modal  =========== --}}
<div id="updatecustomermodal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative p-4 w-full   max-w-6xl max-h-full ">
        <form id="UpdatecustomerData" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="update_id">
            <input type="hidden" name="password" value="12345678">
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Update_Customer')
                    </h3>
                    <button type="button"
                        class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                        data-modal-hide="updatecustomermodal">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-3 md:grid-cols-3 gap-6 mx-6 my-6">
                    <div>
                        <label class="text-[14px] font-normal" for="fullName">@lang('lang.Customer_Name')</label>
                        <input type="text" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="name" id="fullName" placeholder=" @lang('lang.Name_Here')">
                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="email">@lang('lang.Email')</label>
                        <input type="email" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="email" id="email" placeholder=" @lang('lang.Email_Here')">
                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="PhoneNO">@lang('lang.Customer_phone')</label>
                        <input type="number"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="phone_no" id="PhoneNO" placeholder=" @lang('lang.Phone_Here')">

                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mx-6">
                    <div>
                        <label class="text-[14px] font-normal" for="TaxNo">@lang('lang.Tax_Number')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="tax_number" id="TaxNo" placeholder=" @lang('lang.Tax_Number_Here')">

                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="clientType">@lang('lang.Type_Of_Client')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="client_type" id="clientType" placeholder=" @lang('lang.Type_Here')">

                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="postalCode">@lang('lang.Postal_Code')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="postal_code" id="postalCode" placeholder=" @lang('lang.Postal_Code_Here')">

                    </div>

                    <div>
                        <label class="text-[14px] font-normal" for="City">@lang('lang.city')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="city" id="City" placeholder=" @lang('lang.City_Here')">

                    </div>
                </div>
                <div class="grid grid-cols-2 mx-6 gap-4 mt-3">
                    <div class="mt-2  ">
                        <label class="text-[14px] font-normal" for="note">@lang('lang.Note')</label>
                        <textarea name="note" id="note"
                            class="w-full h-24  border-[#DEE2E6] rounded-[4px] focus:border-primary text-[14px] "
                            placeholder="@lang('lang.Note_Here')"></textarea>
                    </div>
                    <div class="mt-2 ">
                        <label class="text-[14px] font-normal" for="Address">@lang('lang.Address')</label>
                        <textarea name="address" id="Address"
                            class="w-full h-24  border-[#DEE2E6] rounded-[4px] focus:border-primary text-[14px] "
                            placeholder="@lang('lang.Address_Here')"></textarea>
                    </div>
                </div>

                <div class="flex justify-end ">
                    <button class="bg-primary text-white py-2 px-6 my-4 rounded-[4px]  mx-6 uaddBtn  font-semibold "
                        id="uaddBtn">
                        <div class=" text-center hidden" id="uspinner">
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
                        <div id="utext">
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
</div>

{{-- ============ add  customer modal  =========== --}}
<div id="addcustomermodal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative p-4 w-full   max-w-6xl max-h-full ">
        <form id="customerData" method="post" enctype="multipart/form-data">
            @csrf
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Add_Customer')
                    </h3>
                    <button type="button"
                        class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                        data-modal-hide="addcustomermodal">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="grid md:grid-cols-3 gap-6 mx-6 my-6">
                    <div>
                        <label class="text-[14px] font-normal" for="fullName">@lang('lang.Customer_Name')</label>
                        <input type="text" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="name" id="fullName" placeholder=" @lang('lang.Name_Here')">
                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="email">@lang('lang.Email')</label>
                        <input type="email" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="email" id="email" placeholder=" @lang('lang.Email_Here')">
                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="PhoneNO">@lang('lang.Customer_phone')</label>
                        <input type="number"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="phone_no" id="PhoneNO" placeholder=" @lang('lang.Phone_Here')">

                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mx-6">
                    <div>
                        <label class="text-[14px] font-normal" for="TaxNo">@lang('lang.Tax_Number')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="tax_number" id="TaxNo" placeholder=" @lang('lang.Tax_Number_Here')">

                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="clientType">@lang('lang.Type_Of_Client')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="client_type" id="clientType" placeholder=" @lang('lang.Type_Here')">

                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="postalCode">@lang('lang.Postal_Code')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="postal_code" id="postalCode" placeholder=" @lang('lang.Postal_Code_Here')">

                    </div>

                    <div>
                        <label class="text-[14px] font-normal" for="City">@lang('lang.city')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="city" id="City" placeholder=" @lang('lang.City_Here')">

                    </div>
                </div>
                <div class="grid grid-cols-2 mx-6 gap-4 mt-3">
                    <div class="mt-2  ">
                        <label class="text-[14px] font-normal" for="note">@lang('lang.Note')</label>
                        <textarea name="note" id="note"
                            class="w-full h-24  border-[#DEE2E6] rounded-[4px] focus:border-primary text-[14px] "
                            placeholder="@lang('lang.Note_Here')"></textarea>
                    </div>
                    <div class="mt-2 ">
                        <label class="text-[14px] font-normal" for="Address">@lang('lang.Address')</label>
                        <textarea name="address" id="Address"
                            class="w-full h-24  border-[#DEE2E6] rounded-[4px] focus:border-primary text-[14px] "
                            placeholder="@lang('lang.Address_Here')"></textarea>
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
                            @lang('lang.Save')
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
        <form id="CustomerStatusData" method="post" enctype="multipart/form-data">
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
                <div class=" mx-6 my-6">
                    <div class="">
                        <label class="text-[14px] font-normal" for="verification">@lang('lang.Status')</label>
                        <select
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="verification" id="verification" required>
                            <option selected disabled>@lang('lang.Select_Verfication_Status')</option>
                            <option value="pending">@lang('lang.Pending')</option>
                            <option value="approved">@lang('lang.Approved')</option>
                        </select>

                    </div>

                </div>
                <div class="flex justify-end ">
                    <button class="bg-primary text-white py-2 px-6 my-4 rounded-[4px]  mx-6 uaddBtn  font-semibold "
                        id="AaddBtn">
                        <div class=" text-center hidden" id="Aspinner">
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
@include('layouts.footer')
<script>
    $(document).ready(function() {
        $('.delButton').click(function() {
            var id = $(this).attr('delId');
            $('#delLink').attr('href', '../delCustomer/' + id);
        });
        $('.updateVerBtn').click(function() {
            var id = $(this).attr('updateId');
            $('#updateid').val(id);
        });
        $("#CustomerStatusData").submit(function(event) {
            $userId = $('#updateid').val();
            var url = "../changeVerStatus/" + $userId;
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
                    $('#Aspinner').removeClass('hidden');
                    $('#Atext').addClass('hidden');
                    $('#AaddBtn').attr('disabled', true);
                },
                success: function(response) {
                    window.location.href = '../customers';

                },
                error: function(jqXHR) {
                    let response = JSON.parse(jqXHR.responseText);
                    console.log("error");
                    Swal.fire(
                        'Warning!',
                        response.message,
                        'warning'
                    );

                    $('#Atext').removeClass('hidden');
                    $('#Aspinner').addClass('hidden');
                    $('#AaddBtn').attr('disabled', false);
                }
            });
        });
        // insert data
        $("#customerData").submit(function(event) {
            var url = "../addCustomer";
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
                    window.location.href = '../customers';

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


        $("#UpdatecustomerData").submit(function(event) {
            var updateId = $('#update_id').val();
            var url = "../CustomerUpdate/" + updateId;
            console.log(url);
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
                    $('#uspinner').removeClass('hidden');
                    $('#utext').addClass('hidden');
                    $('#uaddBtn').attr('disabled', true);
                },
                success: function(response) {
                    window.location.href = '../customers';

                },
                error: function(jqXHR) {
                    let response = JSON.parse(jqXHR.responseText);
                    console.log("error");
                    Swal.fire(
                        'Warning!',
                        response.message,
                        'warning'
                    );

                    $('#utext').removeClass('hidden');
                    $('#uspinner').addClass('hidden');
                    $('#uaddBtn').attr('disabled', false);
                }
            });


        });
        // update  data
        $('.updateBtn').click(function() {
            var updateId = $(this).attr('updateId');
            var url = "../CustomerUpdateData/" + updateId;
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    var customer = response.customer;
                    $('#update_id').val(customer.id);
                    $('#fullName').val(customer.name);
                    $('#email').val(customer.email);
                    $('#PhoneNO').val(customer.phone);
                    $('#Address').val(customer.address);
                    $('#TaxNo').val(customer.tax_number);
                    $('#clientType').val(customer.client_type);
                    $('#postalCode').val(customer.postal_code);
                    $('#City').val(customer.city);
                    $('#note').val(customer.note);


                },
                error: function(jqXHR) {
                    let response = JSON.parse(jqXHR.responseText);
                    Swal.fire(
                        'Warning!',
                        'Product Not Found',
                        'warning'
                    );
                }
            });
        });



    });
</script>

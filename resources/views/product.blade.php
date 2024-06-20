@include('layouts.header')
@include('layouts.nav')
<div class="md:mx-4 mt-12">

    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-between px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.product_List')</h3>
                <div class="flex">

                    <button data-modal-target="addproductmodal" data-modal-toggle="addproductmodal"
                        class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                        @lang('lang.Add_Product')</button>
                    <div>
                        <button data-modal-target="addExcelSheetmodal" data-modal-toggle="addExcelSheetmodal"
                            class="bg-secondary cursor-pointer text-white  ml-4 h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                            @lang('lang.Import_From_Excel')</button> <br>
                        <a href="{{ asset('assets/products sample.xlsx') }}" class="float-end mt-2 font-semibold"
                            download="products">@lang('lang.Download_Example')</a>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="datatable" class="overflow-scroll">
                    <thead class="py-6 bg-primary text-white">
                        <tr>
                            <th>@lang('lang.STN')</th>
                            <th class="whitespace-nowrap">@lang('lang.Image')</th>
                            <th class="whitespace-nowrap">@lang('lang.Code')</th>
                            <th class="whitespace-nowrap">@lang('lang.Name')</th>
                            <th class="whitespace-nowrap">@lang('lang.Category/Sub-Category')</th>
                            <th class="whitespace-nowrap">@lang('lang.Price')</th>
                            <th class="whitespace-nowrap">@lang('lang.Status')</th>
                            <th class="flex  justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $x => $data)
                            <tr class="pt-4">
                                <td>{{ $x + 1 }}</td>
                                <td class="md:w-[220px] w-full">
                                    <img class="h-20 w-20 rounded-full"
                                        src="{{ isset($data->image) ? asset($data->image) : asset('images/favicon(32X32).png') }}"
                                        alt="product Image">
                                </td>
                                <td>{{ $data->code }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->category }} / {{ $data->sub_category }}</td>
                                <td>{{ $data->rate }}</td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    <div class="flex gap-5 items-center justify-center">

                                        <button data-modal-target="Updateproductmodal"
                                            data-modal-toggle="Updateproductmodal"
                                            class=" updateBtn cursor-pointer  w-[42px]"
                                            updateId="{{ $data->id }}"><img width="38px"
                                                src="{{ asset('images/icons/edit.svg') }}" alt="update"></button>
                                        {{-- <a class="w-[42px] md:w-full" href="../delProduct/{{ $data->id }}"><img
                                                width="38px" src="{{ asset('images/icons/delete.svg') }}"
                                                alt="update"></button></a> --}}
                                        <button data-modal-target="deleteData" data-modal-toggle="deleteData"
                                            class="delButton" delId="{{ $data->id }}">
                                            <img width="38px" src="{{ asset('images/icons/delete.svg') }}"
                                                alt="delete" class="cursor-pointer">
                                        </button>
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

{{-- ============ Update  product modal  =========== --}}
<div id="Updateproductmodal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed  top-0 left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative p-4 w-full   max-w-6xl max-h-full ">
        <form id="UpdatecategoryData" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="update_id" name="update_id">
            <div class="relat   ive bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Update_Product')
                    </h3>
                    <button type="button"
                        class=" absolute right-5 text-white bg-transparent rounded-lg text-sm w-8 h-8 "
                        data-modal-hide="Updateproductmodal">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="lg:grid  lg:grid-cols-3 grid-cols-2 gap-x-6 gap-y-2 mx-6 my-6">
                    <div class="  ">
                        <label class="text-[14px] font-normal" for="firstName">@lang('lang.Product_Name')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="name" id="Product_Name" placeholder=" @lang('lang.Name_Here')" required>
                    </div>
                    <div class=" ">
                        <label class="text-[14px] font-normal" for="productCode">@lang('lang.Product_Code')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="code" id="productCode" placeholder=" @lang('lang.Code_Here')" required>
                    </div>
                    <div class="flex gap-2">
                        <div class="w-full">
                            <label class="text-[14px] font-normal" for="category">@lang('lang.Product_Category')</label>
                            <select
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px] category"
                                name="category" id="Ucategory" required>
                                @foreach ($categories as $category)
                                    <option category-tax="{{ $category->tax }}" value="{{ $category->name }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button data-modal-target="addcategorymodal" data-modal-toggle="addcategorymodal" type="button"
                            class="bg-primary text-white  rounded-[4px] py-1.5 px-3 mt-6 mb-3 uaddBtn
                            font-semibold">+</button>
                    </div>
                    <div class="mt-4">
                        <label class="text-[14px] font-normal" for="subCategory">@lang('lang.Product_Sub_Category')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="sub_category" id="subCategory" list="subcategories"
                            placeholder=" @lang('lang.Sub_Category_Here')" required>
                        <datalist id="subcategories">
                            @foreach ($Subcategories as $Subcategory)
                                <option value="{{ $Subcategory->sub_category }}">
                            @endforeach
                        </datalist>
                    </div>
                    <div class="mt-4  ">
                        <label class="text-[14px] font-normal" for="tags">@lang('lang.Product_Tags')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="product_tags" id="tags" placeholder=" @lang('lang.Tags_Here')">
                    </div>
                    <div class="grid grid-cols-3  gap-4  mt-4">
                        <div>
                            <label class="text-[14px] font-normal" for="Price">@lang('lang.Price')</label>
                            <input type="text"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="rate" id="Price" placeholder=" @lang('lang.Price_Here')" required>
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="tax">@lang('lang.Tax')%</label>

                            <input type="text"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px] tax-input"
                                name="tax" id="tax" placeholder="%  @lang('lang.Here')  " required
                                value="0">
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="TotalPrice">@lang('lang.Total_Price')</label>
                            <input type="number"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px] tax-input"
                                name="total_price" id="TotalPrice" readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-2  gap-4  mt-4">
                        <div>
                            <label class="text-[14px] font-normal" for="quantity">@lang('lang.quantity')</label>
                            <input type="number"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="quantity" id="quantity" placeholder=" @lang('lang.quantity_here')" required>
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="quantityAlert">@lang('lang.Alert_on_Quantity')</label>
                            <input type="number"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="quantity_alert" id="quantityAlert" placeholder=" @lang('lang.Alert_Here')"
                                value="0" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2  gap-4  mt-4">
                        <div>
                            <label class="text-[14px] font-normal" for="product_unit">@lang('lang.Unit')</label>
                            <input type="text"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="product_unit" id="product_unit" placeholder=" @lang('lang.Unit_Here')" required>
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="unit_quantity">@lang('lang.Unit_Quantity')</label>
                            <input type="text"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="unit_quantity" id="unit_quantity" placeholder=" @lang('lang.Quantity_Here')" required>

                        </div>

                    </div>
                    <div class="flex  gap-4  mt-4">
                        <div>
                            <label class="text-[14px] font-normal" for="Status">@lang('lang.Status')</label>
                            <select
                                class="w-50% border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="status" id="Status" required>
                                <option value="active">@lang('lang.Active')</option>
                                <option value="un-active">@lang('lang.Not_Active')</option>
                                <option value="un-active">@lang('lang.Not_Active')</option>
                            </select>

                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="image">@lang('lang.Product_Image')</label>
                            <input type="file"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="product_image" id="image">
                        </div>
                    </div>
                    <div class="mt-4 col-span-3">
                        <label class="text-[14px] font-normal" for="description">@lang('lang.Product_Description')</label>
                        <textarea required name="description" id="description"
                            class="w-full h-24  border-[#DEE2E6] rounded-[4px] focus:border-primary text-[14px] "
                            placeholder="@lang('lang.Start_writing_here')"></textarea>
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
{{-- ============ add  Excel modal  =========== --}}
<div id="addExcelSheetmodal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative p-4 w-full   max-w-2xl max-h-full ">
        <form action="{{ url('product/import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Add_Product')
                    </h3>
                    <button type="button"
                        class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                        data-modal-hide="addExcelSheetmodal">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="mx-6 my-6">
                    <div class="  ">
                        <label class="text-[14px] font-normal" for="excelFile">@lang('lang.Excel_File')</label>
                        <input type="file"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary border   h-[40px] text-[14px]"
                            name="excel_file" id="excelFile" required>
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
                            @lang('lang.Add_Product')
                        </div>

                    </button>
                </div>
            </div>
        </form>
        <div>

        </div>

    </div>
</div>
{{-- ============ add  product modal  =========== --}}
<div id="addproductmodal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative p-4 w-full   max-w-6xl max-h-full ">
        <form id="productdata" method="post" enctype="multipart/form-data">
            {{-- <form action="addProduct" method="post" enctype="multipart/form-data"> --}}
            @csrf
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Add_Product')
                    </h3>
                    <button type="button"
                        class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                        data-modal-hide="addproductmodal">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="lg:grid  lg:grid-cols-3 grid-cols-2 gap-x-6 gap-y-2 mx-6 my-6">
                    <div class="  ">
                        <label class="text-[14px] font-normal" for="firstName">@lang('lang.Product_Name')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="name" id="request" placeholder=" @lang('lang.Name_Here')" required>
                    </div>
                    <div class=" lg:mt-0 mt-4">
                        <label class="text-[14px] font-normal" for="productCode">@lang('lang.Product_Code')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="code" id="productCode" placeholder=" @lang('lang.Code_Here')" required>
                    </div>
                    <div class="flex gap-2 lg:mt-0 mt-4">
                        <div class="w-full">
                            <label class="text-[14px] font-normal" for="category">@lang('lang.Product_Category')</label>
                            <select
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px] category "
                                name="category" id="category" required>
                                @foreach ($categories as $category)
                                    <option category-tax="{{ $category->tax }}" value="{{ $category->name }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button data-modal-target="addcategorymodal" data-modal-toggle="addcategorymodal"
                            type="button"
                            class="bg-primary text-white  rounded-[4px] py-1.5 px-3 mt-6 mb-3 uaddBtn
                            font-semibold">+</button>
                    </div>
                    <div class="mt-4">
                        <label class="text-[14px] font-normal" for="subCategory">@lang('lang.Product_Sub_Category')</label>
                        <input type="text" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="sub_category" list="subcategory" id="subCategory"
                            placeholder=" @lang('lang.Sub_Category_Here')">
                        <datalist id="subcategory">
                            @foreach ($Subcategories as $Subcategory)
                                <option value="{{ $Subcategory->sub_category }}">
                            @endforeach
                        </datalist>
                    </div>
                    <div class="mt-4  ">
                        <label class="text-[14px] font-normal" for="tags">@lang('lang.Product_Tags')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="product_tags" id="tags" placeholder=" @lang('lang.Tags_Here')">
                    </div>
                    <div class="grid grid-cols-3  gap-4  mt-4">
                        <div>
                            <label class="text-[14px] font-normal" for="Price">@lang('lang.Price')</label>
                            <input type="text"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="rate" id="WOPrice" placeholder=" @lang('lang.Price_Here')" required>
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="TaxPrice">@lang('lang.Tax')%</label>

                            <input type="number"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px] tax-input"
                                name="tax" id="TaxPrice" placeholder="%  @lang('lang.Here')  " required
                                value="0">
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="tax">@lang('lang.Total_Price')</label>
                            <input type="number"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px] tax-input"
                                name="total_price" id="TotalWTax" readonly>
                        </div>
                    </div>
                    <div class="grid grid-cols-2  gap-4  mt-4">
                        <div>
                            <label class="text-[14px] font-normal" for="quantity">@lang('lang.quantity')</label>
                            <input type="number"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="quantity" id="quantity" placeholder=" @lang('lang.quantity_here')" required>
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="quantityAlert">@lang('lang.Alert_on_Quantity')</label>
                            <input type="number"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="quantity_alert" id="quantityAlert" placeholder=" @lang('lang.Alert_Here')" required
                                value="0">
                        </div>
                    </div>
                    <div class="grid grid-cols-2  gap-4  mt-4">
                        <div>
                            <label class="text-[14px] font-normal" for="product_unit">@lang('lang.Unit')</label>
                            <input type="text"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="product_unit" id="product_unit" placeholder=" @lang('lang.Unit_Here')" required>
                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="unit_quantity">@lang('lang.Unit_Quantity')</label>
                            <input type="text"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="unit_quantity" id="unit_quantity" placeholder=" @lang('lang.Quantity_Here')" required>

                        </div>
                    </div>
                    <div class="mt-4 flex gap-3">
                        <div>
                            <label class="text-[14px] font-normal" for="status">@lang('lang.Status')</label>
                            <select
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="status" id="status" required>
                                <option value="active">@lang('lang.Active')</option>
                                <option value="un-active">@lang('lang.Not_Active')</option>
                            </select>

                        </div>
                        <div>
                            <label class="text-[14px] font-normal" for="image">@lang('lang.Product_Image')</label>
                            <input type="file"
                                class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                                name="product_image" id="image">
                        </div>
                    </div>
                    <div class="mt-4 col-span-3">
                        <label class="text-[14px] font-normal" for="description">@lang('lang.Product_Description')</label>
                        <textarea name="description" id="description"
                            class="w-full h-24  border-[#DEE2E6] rounded-[4px] focus:border-primary text-[14px] "
                            placeholder="@lang('lang.Start_writing_here')" required></textarea>
                    </div>
                </div>

                <div class="flex justify-end ">
                    <button class="bg-primary text-white py-2 px-6 my-4 rounded-[4px]  mx-6 uaddBtn  font-semibold "
                        id="iaddBtn">
                        <div class=" text-center hidden" id="ispinner">
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
                        <div id="itext">
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

{{-- ============ add  category modal  =========== --}}
<div id="addcategorymodal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed  top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative p-4 w-full   max-w-4xl max-h-full ">
        <form id="categoryData" method="post" enctype="multipart/form-data">
            @csrf
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Add_Category')
                    </h3>
                    <button type="button"
                        class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                        data-modal-hide="addcategorymodal" id="category-modal-close">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="grid lg:grid-cols-2 gap-x-6 gap-y-4  mx-6 my-6">
                    <div>
                        <label class="text-[14px] font-normal" for="Name">@lang('lang.Category_Name')</label>
                        <input type="text" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="name" id="CategoryName" placeholder=" @lang('lang.Name_Here')">
                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="tax">@lang('lang.Tax')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6]  border rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="tax" id="tax" placeholder="% @lang('lang.Here')">
                    </div>
                    <div>
                        <label class="text-[14px] font-normal" for="image">@lang('lang.Image')</label>
                        <input type="file"
                            class="w-full border-[#DEE2E6]  border rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="category_img" id="image">
                    </div>
                    <div class="">
                        <label class="text-[14px] font-normal" for="Status">@lang('lang.Status')</label>
                        <select
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="status" id="status">
                            <option value="active">@lang('lang.Active')</option>
                            <option value="not-active">@lang('lang.Not_Active')</option>
                        </select>

                    </div>
                </div>
                <div class="flex justify-end ">
                    <button class="bg-primary text-white py-2 px-6 my-4 rounded-[4px]  mx-6 uaddBtn  font-semibold "
                        id="CaddBtn">
                        <div class=" text-center hidden" id="Cspinner">
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
                        <div id="Ctext">
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


@include('layouts.footer')
<script>
    $(document).ready(function() {
        $('#WOPrice , #Price').on('input', function() {
            var inputValue = $(this).val();
            $(this).val(inputValue.replace(/,/g, '.'));
        });


        $('.delButton').click(function() {
            var id = $(this).attr('delId');
            $('#delLink').attr('href', '../delProduct/' + id);
            console.log(id);
        });
        $(document).ready(function() {
            function calculateTotal() {
                var price = parseFloat($('#WOPrice').val()) || 0;
                var tax = parseFloat($('#TaxPrice').val()) || 0;
                var totalPrice = price + (price * (tax / 100));
                $('#TotalWTax').val(totalPrice.toFixed(2));
            }

            $('#WOPrice, #TaxPrice').on('input', calculateTotal);

            function calculateTotal2() {
                var price = parseFloat($('#Price').val()) || 0;
                var tax = parseFloat($('#tax').val()) || 0;
                var totalPrice = price + (price * (tax / 100));
                $('#TotalPrice').val(totalPrice.toFixed(2));
            }
            $('#Price').trigger('tax');
            $('#Price, #tax').on('input', calculateTotal2);

            $('.category').change(function() {
                var selectedOption = $(this).find(':selected');
                var tax = selectedOption.attr('category-tax');
                $('.tax-input').val(tax)
            });
            // insert data
            $("#productdata").submit(function(event) {
                var url = "../addProduct";
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
                        $('#ispinner').removeClass('hidden');
                        $('#itext').addClass('hidden');
                        $('#iaddBtn').attr('disabled', true);
                    },
                    success: function(response) {
                        window.location.href = '../product';

                    },
                    error: function(jqXHR) {
                        let response = JSON.parse(jqXHR.responseText);
                        console.log("error");
                        Swal.fire(
                            'Warning!',
                            response.message,
                            'warning'
                        );

                        $('#itext').removeClass('hidden');
                        $('#ispinner').addClass('hidden');
                        $('#iaddBtn').attr('disabled', false);
                    }
                });
            });

            // update  data
            $('.updateBtn').click(function() {
                var updateId = $(this).attr('updateId');
                var url = "../ProductUpdataData/" + updateId;
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        var product = response.product;
                        console.log(product);
                        $('#update_id').val(product.id);
                        $('#Product_Name').val(product.name);
                        $('#productCode').val(product.code);
                        $('#Ucategory').val(product.category);
                        $('#subCategory').val(product.sub_category);
                        $('#tags').val(product.tags);
                        $('#Price').val(product.rate);
                        $('#tax').val(product.tax);
                        $('#quantity').val(product.quantity);
                        $('#quantityAlert').val(product.quantity_alert);
                        $('#Status').val(product.status);
                        $('#description').val(product.description);
                        $('#product_unit').val(product.product_unit);

                    },
                    error: function(jqXHR) {
                        let response = JSON.parse(jqXHR.responseText);
                        console.log("error");
                        Swal.fire(
                            'Warning!',
                            'Product Not Found',
                            'warning'
                        );
                    }
                });
            })

            //  insert category data

            $("#categoryData").submit(function(event) {
                var url = "../addCategory";
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
                        $('#Cspinner').removeClass('hidden');
                        $('#Ctext').addClass('hidden');
                        $('#CaddBtn').attr('disabled', true);
                    },
                    success: function(response) {
                        var categoryName = response.category.name;
                        var categoryTax = response.category.tax;
                        $('#category-modal-close').click();
                        var newOption = $('<option>', {
                            value: categoryName,
                            text: categoryName,
                            'category-tax': categoryTax
                        });
                        $('#category').append(newOption);
                    },
                    error: function(jqXHR) {
                        let response = JSON.parse(jqXHR.responseText);
                        console.log("error");
                        Swal.fire(
                            'Warning!',
                            response.message,
                            'warning'
                        );

                        $('#Ctext').removeClass('hidden');
                        $('#Cspinner').addClass('hidden');
                        $('#CaddBtn').attr('disabled', false);
                    }
                });
            });
            $("#UpdatecategoryData").submit(function(event) {
                var updateId = $('#update_id').val();
                var url = "../UpdataProduct/" + updateId;
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
                        window.location.href = '../product';


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

        });

    });
</script>

@include('layouts.header')
@include('layouts.nav')
<div class="md:mx-4 mt-12">

    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Sites_List')</h3>
                <div class="flex">

                    <button data-modal-target="addsitemodal" data-modal-toggle="addsitemodal" id="addModal"
                        class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                        @lang('lang.Add_Site')</button>
                    <div>
                        <button data-modal-target="addExcelSheetmodal" data-modal-toggle="addExcelSheetmodal"
                            class="bg-secondary cursor-pointer text-white  ml-4 h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                            @lang('lang.Import_From_Excel')</button> <br>
                        <a href="{{ asset('assets/website.xlsx') }}" class="float-end mt-1 font-semibold"
                            download="Website-Sample">@lang('lang.Download_Example')</a>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="datatable">
                    <thead class="py-1 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap text-sm">@lang('lang.STN')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.Add_From')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.URL')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.Traffic')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.Semrush_Href') <br>@lang('lang.Traffic')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.Price')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.Insertion') <br> @lang('lang.Price')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.Exchange')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.DA')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.DR')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.Casino')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.Category')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.Contact_No')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.Done_From')</th>
                            <th class="whitespace-nowrap text-sm">@lang('lang.Admin_Gmail')</th>
                            <th class="flex  justify-center text-sm">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $data)
                            <tr>
                                <td class="text-sm">{{ $loop->iteration }}</td>
                                <td class="text-sm">{{ \App\Models\User::find($data->user_id)->name }}</td>

                                <td class="text-sm"><a href="{{ $data->web_url }}" target="_blank"
                                        class="text-blue-500">@lang('lang.Link')</a></td>
                                <td class="text-sm">{{ $data->traffic }}</td>
                                <td class="text-sm">{{ $data->semrush_traffic }} / {{ $data->ahref_traffic }}</td>
                                <td class="text-sm">{{ $data->guest_post_price }}</td>
                                <td class="text-sm">{{ $data->link_insertion_price }}</td>
                                <td class="text-sm">{{ $data->exchange }}</td>
                                <td class="text-sm">{{ $data->da }}</td>
                                <td class="text-sm">{{ $data->dr }}</td>
                                <td class="text-sm">{{ $data->casino }}</td>
                                <td class="text-sm">{{ $data->category }}</td>
                                <td class="text-sm">{{ $data->contact_no }}</td>
                                <td class="text-sm">{{ $data->site_done_from }}</td>
                                <td class="text-sm">{{ $data->admin_gmail }}</td>
                                <td>
                                    <div class="flex gap-5 items-center justify-center">

                                        <a href="{{ route('updateSite', $data->id) }}">
                                            <button class=" updateBtn cursor-pointer  w-[42px]"
                                                updateId="{{ $data->id }}"><img width="38px"
                                                    src="{{ asset('images/icons/update.svg') }}"
                                                    alt="update"></button>
                                        </a>
                                        <a href="../delSite/{{ $data->id }}" class="delButton">
                                            <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle opacity="0.1" cx="18" cy="18" r="18"
                                                    fill="#DF6F79" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M23.4905 13.7433C23.7356 13.7433 23.9396 13.9468 23.9396 14.2057V14.4451C23.9396 14.6977 23.7356 14.9075 23.4905 14.9075H13.0493C12.8036 14.9075 12.5996 14.6977 12.5996 14.4451V14.2057C12.5996 13.9468 12.8036 13.7433 13.0493 13.7433H14.8862C15.2594 13.7433 15.5841 13.478 15.6681 13.1038L15.7642 12.6742C15.9137 12.0889 16.4058 11.7002 16.9688 11.7002H19.5704C20.1273 11.7002 20.6249 12.0889 20.7688 12.6433L20.8718 13.1032C20.9551 13.478 21.2798 13.7433 21.6536 13.7433H23.4905ZM22.5573 22.4946C22.7491 20.7073 23.0849 16.4611 23.0849 16.4183C23.0971 16.2885 23.0548 16.1656 22.9709 16.0667C22.8808 15.9741 22.7669 15.9193 22.6412 15.9193H13.9028C13.7766 15.9193 13.6565 15.9741 13.5732 16.0667C13.4886 16.1656 13.447 16.2885 13.4531 16.4183C13.4542 16.4261 13.4663 16.5757 13.4864 16.8258C13.5759 17.9366 13.8251 21.0305 13.9861 22.4946C14.1001 23.5731 14.8078 24.251 15.8328 24.2756C16.6238 24.2938 17.4387 24.3001 18.272 24.3001C19.0569 24.3001 19.854 24.2938 20.6696 24.2756C21.7302 24.2573 22.4372 23.5914 22.5573 22.4946Z"
                                                    fill="#D11A2A" />
                                            </svg>

                                        </a>

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


{{-- ============ add  site modal  =========== --}}
<div id="addsitemodal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="fixed inset-0 transition-opacity">
        <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
    </div>
    <div class="relative p-4 w-full   max-w-6xl max-h-full ">
        @if (isset($site))
            <form action="{{ route('updateSiteData', $site->id) }}" method="post" enctype="multipart/form-data">
            @else
                <form id="recordData" method="post" enctype="multipart/form-data" action="../addSites">
        @endif
        @csrf
        <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
            <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-xl font-semibold text-white ">
                    @lang('lang.Add_Site')
                </h3>
                <button type="button"
                    class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                    data-modal-hide="addsitemodal">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <div class="grid md:grid-cols-4 gap-6 mx-6 my-4">
                <div>
                    <label class="text-[14px] font-normal" for="website_url">@lang('lang.Website_URL')</label>
                    <input type="text" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="website_url" id="website_url" placeholder=" @lang('lang.Website_URL')"
                        value="{{ $site->web_url ?? '' }}">
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="traffic">@lang('lang.Traffic')</label>
                    <input type="text" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="traffic" id="traffic" placeholder=" @lang('lang.Traffic_Here')"
                        value="{{ $site->traffic ?? '' }}">
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="semrush_traffic">@lang('lang.Semrush_Traffic')</label>
                    <input type="text"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="semrush_traffic" id="semrush_traffic" placeholder=" @lang('lang.Semrush_Traffic')"
                        value="{{ $site->semrush_traffic ?? '' }}">

                </div>
                <div>
                    <label class="text-[14px] font-normal" for="ahrref_traffic">@lang('lang.Ahref_Traffic')</label>
                    <input type="text"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="ahrref_traffic" id="ahrref_traffic" placeholder=" @lang('lang.Ahref_Traffic')"
                        value="{{ $site->ahref_traffic ?? '' }}">
                </div>
            </div>
            <div class="grid md:grid-cols-4 gap-6 mx-6 my-4">

                <div>
                    <label class="text-[14px] font-normal" for="traffic_major_from">@lang('lang.Traffic_Major_From')</label>
                    <input type="text" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="traffic_major_from" id="traffic_major_from" placeholder=" @lang('lang.Traffic_Major_From')"
                        value="{{ $site->traffic_from ?? '' }}">
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="guest_post_price">@lang('lang.Guest_Post_Price')</label>
                    <input type="text" min="1"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="guest_post_price" id="guest_post_price" placeholder=" @lang('lang.Guest_Post_Price')"
                        value="{{ $site->guest_post_price ?? '' }}">

                </div>
                <div>
                    <label class="text-[14px] font-normal" for="link_insertion_price">@lang('lang.Link_Insertion_Price')</label>
                    <input type="number" min="1"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="link_insertion_price" id="link_insertion_price" placeholder=" @lang('lang.Link_Insertion_Price')"
                        value="{{ $site->link_insertion_price ?? '' }}">
                </div>
                <div class="flex gap-4">
                    <div>
                        <label class="text-[14px] font-normal" for="Dr">@lang('lang.DR')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="dr" id="Dr" placeholder=" @lang('lang.DR')"
                            value="{{ $site->dr ?? '' }}">
                    </div>


                    <div>
                        <label class="text-[14px] font-normal" for="DA">@lang('lang.DA')</label>
                        <input type="text"
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                            name="da" id="DA" placeholder=" @lang('lang.DA')"
                            value="{{ $site->da ?? '' }}">

                    </div>
                </div>
            </div>
            <div class="grid md:grid-cols-3 gap-6 mx-6 my-4">

                <div>
                    <label class="text-[14px] font-normal" for="exchange">@lang('lang.Exchange')</label>
                    <select class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="exchange" id="exchange">
                        <option {{ isset($site) && $site->exchange == 'link insertion' ? 'selected' : '' }}
                            value="link insertion">
                            @lang('lang.Link_Insertion')
                        </option>
                        <option {{ isset($site) && $site->exchange == 'guest post' ? 'selected' : '' }}
                            value="guest post">
                            @lang('lang.Guest_Post')</option>
                        <option value="both" {{ isset($site) && $site->exchange == 'both' ? 'selected' : '' }}>
                            @lang('lang.Both')
                        </option>
                    </select>
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="contact_no">@lang('lang.Contact_No')</label>
                    <input type="number" min="1"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="contact_no" id="contact_no" placeholder=" @lang('lang.Contact_No')"
                        value="{{ $site->contact_no ?? '' }}">

                </div>
                <div>
                    <label class="text-[14px] font-normal" for="Casino">@lang('lang.Casino')</label>
                    <select name="casino" id="Casino">
                        <option disabled>@lang('lang.Select_Casino')</option>
                        <option value="yes" {{ isset($site->casino) && $site->casino == 'yes' ? 'selected' : '' }}>
                            @lang('lang.Yes')</option>
                        <option value="no" {{ isset($site->casino) && $site->casino == 'no' ? 'selected' : '' }}>
                            @lang('lang.No')</option>
                    </select>
                </div>
            </div>
            <div class="grid md:grid-cols-3 gap-6 mx-6 my-4">
                <div>
                    <label class="text-[14px] font-normal" for="category">@lang('lang.Website_Category')</label>
                    <input type="text"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="category" id="category" placeholder=" @lang('lang.Category_Here')"
                        value="{{ $site->category ?? '' }}">
                </div>


                <div>
                    <label class="text-[14px] font-normal" for="site_done_form">@lang('lang.Site_Done_From')</label>
                    <input type="text"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="site_done_form" id="site_done_form" placeholder=" @lang('lang.Site_Done_From')"
                        value="{{ $site->site_done_from ?? '' }}">

                </div>
                <div>
                    <label class="text-[14px] font-normal" for="admin_gmail">@lang('lang.Admin_Gmail')</label>
                    <input type="text"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="admin_gmail" id="admin_gmail" placeholder=" @lang('lang.Admin_Gmail')"
                        value="{{ $site->admin_gmail ?? '' }}">
                </div>
            </div>
            <div class=" mx-6 my-4">

                <div>
                    <label class="text-[14px] font-normal" for="admin_gmail">@lang('lang.Guidelines')</label>
                    <textarea name="guideline" class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[140px] text-[14px]"
                        placeholder="@lang('lang.Guidelines_Here')" maxlength="500">{{ $site->guideline ?? '' }}</textarea>
                    <p class="text-sm font-bold text-neutral-600 ml-2">500 letters Only</p>
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
                        @lang(!isset($site) ? 'lang.Save' : 'lang.Update')
                    </div>

                </button>
            </div>
        </div>
        </form>
        <div>

        </div>

    </div>
</div>
<div class="fixed inset-0 transition-opacity">
    <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
</div>
{{-- ============ add  Excel modal  =========== --}}
<div id="addExcelSheetmodal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="fixed inset-0 transition-opacity">
        <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
    </div>
    <div class="relative p-4 w-full   max-w-2xl max-h-full ">
        <form action="../site/import" method="post" enctype="multipart/form-data">
            @csrf
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Add_Site')
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
                            @lang('lang.Add_Site')
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

@if (isset($site))
    <script>
        $(document).ready(function() {
            $('#addsitemodal').removeClass("hidden");
            $('#addsitemodal').addClass("flex");

        });
    </script>
@endif
<script>
    $(document).ready(function() {
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



    });
</script>

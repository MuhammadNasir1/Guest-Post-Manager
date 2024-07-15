@include('layouts.header')
@include('layouts.nav')
@php
    $company = DB::table('companies')->first();
@endphp
@if (isset($company->logo))
    @php

        $img = $company->logo;
    @endphp
@else
    @php
        $img = 'images/comapnylogo.svg';
    @endphp
@endif
<div class="md:mx-4 mt-12">

    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Users_List')</h3>
                <div>

                    <button data-modal-target="addcustomermodal" data-modal-toggle="addcustomermodal"
                        class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                        @lang('lang.Add_User')</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="datatable">
                    <thead class="py-1 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">@lang('lang.STN')</th>
                            <th class="whitespace-nowrap">@lang('lang.Image')</th>
                            <th class="whitespace-nowrap">@lang('lang.Name')</th>
                            <th class="whitespace-nowrap">@lang('lang.Email')</th>
                            <th class="whitespace-nowrap">@lang('lang.Phone_No')</th>
                            <th class="whitespace-nowrap">@lang('lang.Role')</th>
                            <th class="flex  justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>
                                    <div class="rounded-full flex justify-content-center ">
                                        <img src="{{ isset($data->user_image) ? asset($data->user_image) : asset($img) }}"
                                            class="object-contain rounded-full h-[80px] w-[80px] bg-slate-400"
                                            width="80">
                                    </div>

                                    {{-- <img src="{{ $data->user_image }}" alt=""> --}}
                                    {{-- {{ asset($data->user_image) }} --}}
                                </td>

                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->phone_no }}</td>
                                <td>{{ $data->role }}</td>
                                <td>
                                    <div class="flex gap-5 items-center justify-center">

                                        <a href="{{ route('updateUser', $data->id) }}">
                                            <button data-modal-target="Updateproductmodal"
                                                data-modal-toggle="Updateproductmodal"
                                                class=" updateBtn cursor-pointer  w-[42px]"
                                                updateId="{{ $data->id }}"><img width="38px"
                                                    src="{{ asset('images/icons/edit.svg') }}" alt="update"></button>
                                        </a>
                                        <a href="{{ route('deleteUser', $data->id) }}">
                                            <button data-modal-target="deleteData" data-modal-toggle="deleteData"
                                                class="delButton" delId="{{ $data->id }}">
                                                <img width="38px" src="{{ asset('images/icons/delete.svg') }}"
                                                    alt="delete" class="cursor-pointer">
                                            </button>
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




{{-- ============ add  customer modal  =========== --}}
<div id="addcustomermodal" data-modal-backdrop="static"
    class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
    <div class="fixed inset-0 transition-opacity">
        <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
    </div>
    <div class="relative p-4 w-full   max-w-6xl max-h-full ">
        @if (isset($user))
            <form action="../updateUserCar/{{ $user->id }}" method="post" enctype="multipart/form-data">
            @else
                <form id="customerData" method="post" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
            <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-xl font-semibold text-white ">
                    @lang('lang.Add_User')
                </h3>
                <button type="button"
                    class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                    data-modal-hide="addcustomermodal">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <div class="h-[200px] w-[200px] relative mx-auto my-5 rounded-[50%]">
                <img id="img_view" height="200px" width="200px"
                    class="h-[200px] w-[200px]  border border-primary  rounded-[50%] cursor-pointer object-contain "
                    src=" {{ isset($user->user_image) ? asset($user->user_image) : 'images/owlicon.svg' }}"
                    alt="user">
                <input class="absolute top-0 opacity-0     h-[210px] w-[200px] z-50 cursor-pointer " type="file"
                    name="upload_image" id="user_image">
                <div class="absolute bottom-[6px] right-5  z-10">
                    <button type="button">
                        <svg width="42" height="42" viewBox="0 0 36 36" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="18" cy="18" r="18" fill="#EDBD58" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.1627 23.6197L22.3132 15.666C22.6474 15.2371 22.7663 14.7412 22.6549 14.2363C22.5583 13.7773 22.276 13.3408 21.8526 13.0097L20.8201 12.1895C19.9213 11.4747 18.8071 11.5499 18.1683 12.3701L17.4775 13.2663C17.3883 13.3785 17.4106 13.544 17.522 13.6343C17.522 13.6343 19.2676 15.0339 19.3048 15.064C19.4236 15.1769 19.5128 15.3274 19.5351 15.508C19.5722 15.8616 19.3271 16.1927 18.9631 16.2379C18.7922 16.2605 18.6288 16.2078 18.51 16.11L16.6752 14.6502C16.5861 14.5832 16.4524 14.5975 16.3781 14.6878L12.0178 20.3314C11.7355 20.6851 11.639 21.1441 11.7355 21.588L12.2927 24.0035C12.3224 24.1314 12.4338 24.2217 12.5675 24.2217L15.0188 24.1916C15.4645 24.1841 15.8804 23.9809 16.1627 23.6197ZM19.5948 22.8676H23.5918C23.9818 22.8676 24.299 23.1889 24.299 23.5839C24.299 23.9797 23.9818 24.3003 23.5918 24.3003H19.5948C19.2048 24.3003 18.8876 23.9797 18.8876 23.5839C18.8876 23.1889 19.2048 22.8676 19.5948 22.8676Z"
                                fill="white" />
                        </svg>
                    </button>

                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6 mx-6 my-6">
                <div>
                    <label class="text-[14px] font-normal" for="user_name">@lang('lang.User_Name')</label>
                    <input type="text" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="name" id="user_name" value="{{ $user->name ?? '' }}"
                        placeholder=" @lang('lang.User_Name_Here')">
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="user_email">@lang('lang.Email_Address')</label>
                    <input type="email" required
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="email" id="user_email" placeholder=" @lang('lang.Email_Address_Here')"
                        value="{{ $user->email ?? '' }}">
                </div>

            </div>
            <div class="grid  md:grid-cols-3 gap-6 mx-6 my-6">

                <div>
                    <label class="text-[14px] font-normal" for="password">@lang('lang.Password')</label>
                    <input type="password"
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="password" id="password" placeholder=" @lang('lang.Password_Here')"
                        {{ isset($user->id) ? '' : 'required' }}>
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="confirm_password">@lang('lang.Confirm_Password')</label>
                    <input type="password" {{ isset($user->id) ? '' : 'required' }}
                        class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary   h-[40px] text-[14px]"
                        name="confirm_password" id="confirm_password" placeholder=" @lang('lang.Confirm_Password_Here')">
                </div>
                <div>
                    <label class="text-[14px] font-normal" for="role">@lang('lang.Role')</label>
                    <select name="role" id="role">
                        <option value="seller" {{ isset($user->role) && $user->role == 'seller' ? 'selected' : '' }}>
                            Seller</option>
                        <option value="manager"
                            {{ isset($user->role) && $user->role == 'manager' ? 'selected' : '' }}>
                            Manager</option>
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
@if (isset($user))
    <script>
        $(document).ready(function() {
            $('#addcustomermodal').removeClass("hidden");

        });
    </script>
@endif
<script>
    let fileInput = document.getElementById('user_image');
    let imageView = document.getElementById('img_view');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            imageView.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });
    $(document).ready(function() {
        $('.delButton').click(function() {
            var id = $(this).attr('delId');
            $('#delLink').attr('href', '../delCustomer/' + id);
        });
        // insert data
        $("#customerData").submit(function(event) {
            var url = "../registerdata";
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
                    window.location.href = '../users';


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

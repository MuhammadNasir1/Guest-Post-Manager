@include('layouts.header')
@include('layouts.nav')

<div class="lg:mx-4 mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl ">Add Company</h1>
    </div>

    <div id="reloadDiv" class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <form action="{{ route('addCompany') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="" autocomplete="off">
            <div class="p-8">
                <div class="flex items-center flex-col gap-2">
                    <div class="h-[200px] w-[200px] relative  rounded-[50%]">
                        <img id="img_view" height="200px" width="200px"
                            class="h-[200px] w-[200px]  border border-primary  rounded-[50%] cursor-pointer object-contain "
                            src=" {{ isset($user->user_image) ? asset($user->user_image) : 'images/owlicon.svg' }}"
                            alt="user">
                        <input class="absolute top-0 opacity-0     h-[210px] w-[200px] z-50 cursor-pointer "
                            type="file" name="upload_image" id="user_image">
                        <div class="absolute bottom-[6px] right-5  z-10 ">
                            <button type="button">
                                <svg width="42" height="42" viewBox="0 0 36 36" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="18" cy="18" r="18" fill="#417DFC" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.1627 23.6197L22.3132 15.666C22.6474 15.2371 22.7663 14.7412 22.6549 14.2363C22.5583 13.7773 22.276 13.3408 21.8526 13.0097L20.8201 12.1895C19.9213 11.4747 18.8071 11.5499 18.1683 12.3701L17.4775 13.2663C17.3883 13.3785 17.4106 13.544 17.522 13.6343C17.522 13.6343 19.2676 15.0339 19.3048 15.064C19.4236 15.1769 19.5128 15.3274 19.5351 15.508C19.5722 15.8616 19.3271 16.1927 18.9631 16.2379C18.7922 16.2605 18.6288 16.2078 18.51 16.11L16.6752 14.6502C16.5861 14.5832 16.4524 14.5975 16.3781 14.6878L12.0178 20.3314C11.7355 20.6851 11.639 21.1441 11.7355 21.588L12.2927 24.0035C12.3224 24.1314 12.4338 24.2217 12.5675 24.2217L15.0188 24.1916C15.4645 24.1841 15.8804 23.9809 16.1627 23.6197ZM19.5948 22.8676H23.5918C23.9818 22.8676 24.299 23.1889 24.299 23.5839C24.299 23.9797 23.9818 24.3003 23.5918 24.3003H19.5948C19.2048 24.3003 18.8876 23.9797 18.8876 23.5839C18.8876 23.1889 19.2048 22.8676 19.5948 22.8676Z"
                                        fill="white" />
                                </svg>
                            </button>

                        </div>
                    </div>
                    <p class="text-[#ACADAE]  text-[16px]"></p>
                </div>
                <div class="md:flex gap-[30px] mt-3">
                    <div class="md:w-[50%] w-full mt-4">
                        <label class="text-[16px] font-semibold block  text-[#452C88]" for="company_name">Enter Company
                            Name</label>
                        <input type="text"
                            class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                            name="company_name" id="company_name" placeholder="Enter Company Name" value="">
                    </div>

                    <div class="md:w-[50%]  w-full mt-4">
                        <label class="text-[16px] font-semibold block  text-[#452C88]" for="company_phone">Company Phone
                            No</label>
                        <input type="number"
                            class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                            name="company_phone" id="company_phone" placeholder="Enter Company No" value="">
                    </div>
                </div>
                <div class="md:flex gap-[30px] mt-3">
                    <div class="md:w-[50%] w-full mt-4">
                        <label class="text-[16px] font-semibold block  text-[#452C88]" for="email_or_website">Company
                            Email or
                            Website</label>
                        <input type="text"
                            class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                            name="email_or_website" id="email_or_website" placeholder="Email or Website" value="">
                    </div>

                    <div class="md:flex md:w-[50%]   gap-[30px]">
                        <div class=" w-full mt-4">
                            <label class="text-[16px] font-semibold block  text-[#452C88]" for="primary_color">Primary
                                Color</label>
                            <input type="color"
                                class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                                name="primary_color" id="primary_color" value="">
                        </div>
                        <div class=" w-full mt-4">
                            <label class="text-[16px] font-semibold block  text-[#452C88]"
                                for="secondary_color">Secondary
                                Color</label>
                            <input type="color"
                                class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                                name="secondary_color" id="secondary_color" value="">
                        </div>
                    </div>
                </div>
                <div class="md:flex gap-[30px] mt-3">
                    <div class="md:w-[50%] w-full mt-4">
                        <label class="text-[16px] font-semibold block  text-[#452C88]" for="personal_no">Company
                            Personal No</label>
                        <input type="text"
                            class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                            name="personal_no" id="personal_no" placeholder="Enter Personal No" value="">
                    </div>

                    <div class="md:w-[50%]  w-full mt-4">
                        <label class="text-[16px] font-semibold block  text-[#452C88]" for="company_ntn">Company
                            Ntn</label>
                        <input type="text"
                            class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                            name="company_ntn" placeholder="Enter Comapny Ntn" id="company_ntn" value="">
                    </div>
                </div>
                <div class=" mt-4">
                    <div class="w-full mt-4">
                        <label class="text-[16px] font-semibold block  text-[#452C88]" for="company_address">Company
                            Address</label>
                        <input type="text"
                            class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                            name="company_address" id="company_address" placeholder="Enter Company Address"
                            value="">
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
</script>

@include('layouts.footer')

@include('layouts.header')
@include('layouts.nav')

<div class="lg:mx-4 mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl ">@lang('lang.Transaction_Voucher')</h1>
    </div>

    <div id="reloadDiv" class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="" autocomplete="off">
            <div class="p-8">

                <div class="md:flex gap-[30px] mt-3">
                    <div class="md:w-[50%] w-full mt-4">
                        <label class="text-[16px] font-semibold block  text-[#452C88]"
                            for="date">@lang('lang.Date')</label>
                        <input type="date"
                            class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                            name="date" id="date">
                    </div>

                    <div class="md:w-[50%] flex  items-center gap-5 w-full mt-4">
                        <div class="w-full">
                            <label class="text-[16px] font-semibold block  text-[#452C88]"
                                for="account">@lang('lang.Account')</label>
                            <select
                                class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                                name="account" id="account" required>
                                <option selected disabled>@lang('lang.Change_Status')</option>
                                <option value="pending">@lang('lang.Pending')</option>
                                <option value="approved">@lang('lang.Approved')</option>
                                <option value="processing">@lang('lang.Processing')</option>
                            </select>
                        </div>
                        <div class="w-full bg-gray py-2 ps-3 mt-6 rounded-[6px]">
                            Balance : <span>0</span>
                        </div>
                    </div>
                </div>
                <div class="md:flex gap-[30px] mt-3">
                    <div class="md:w-[50%] w-full mt-4">
                        <label class="text-[16px] font-semibold block  text-[#452C88]"
                            for="credit">@lang('lang.Credit')</label>
                        <input type="number" min="0"
                            class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                            name="credit" id="credit" placeholder="@lang('lang.Credit')" value="">
                    </div>

                    <div class="md:flex md:w-[50%]   gap-[30px]">
                        <div class=" w-full mt-4">
                            <label class="text-[16px] font-semibold block  text-[#452C88]"
                                for="debit">@lang('lang.Debit')</label>
                            <input type="number" min="0"
                                class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                                name="debit" id="debit" placeholder="@lang('lang.Debit')" value="">
                        </div>

                    </div>
                </div>
                <div class="mt-3">
                    <div class="w-full mt-4">
                        <label class="text-[16px] font-semibold block  text-[#452C88]"
                            for="personal_no">@lang('lang.Hint')</label>
                        <input type="text"
                            class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                            name="personal_no" id="personal_no" placeholder="Enter Personal No" value="">
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
    // let credit = document.getElementById("credit");
    // let debit = document.getElementById("debit");

    // if (credit.value == "") {

    // }
</script>



@include('layouts.footer')

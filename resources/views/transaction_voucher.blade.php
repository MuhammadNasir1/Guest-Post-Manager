@include('layouts.header')
@include('layouts.nav')
<div class="lg:mx-4 mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl ">@lang('lang.Transaction_Voucher')</h1>
    </div>

    <div id="reloadDiv" class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        @if (!isset($transaction))
            <form action="{{ route('addVoucher') }}" method="post" enctype="multipart/form-data">
            @else
                <form action="../editVoucher/{{ $transaction->id ?? '' }}" method="post" enctype="multipart/form-data">
        @endif
        @csrf
        <input type="hidden" name="user_id" value="" autocomplete="off">
        <div class="p-8">

            <div class="grid grid-cols-5 gap-5 mt-4">
                <div class="w-full ">
                    <label class="text-[16px] font-semibold block  text-[#452C88]"
                        for="date">@lang('lang.Date')</label>
                    <input type="date"
                        class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                        name="date" id="date" value="{{ old('hint', $voucher->date ?? '') }}" required>
                </div>

                <div class="w-full">
                    <label class="text-[16px] font-semibold block mb-2  text-[#452C88]"
                        for="account">@lang('lang.Account')</label>
                    <select required
                        class="w-full  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                        name="account" id="account">
                        <option selected disabled>@lang('lang.Change_Status')</option>
                        @foreach ($user as $user)
                            <option {{ isset($transaction) && $transaction->user_id == $user->id ? 'selected' : '' }}
                                value="{{ $user->id }}" class="capitalize">{{ $user->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="w-full">
                    <label class="text-[16px] font-semibold block mb-2  text-[#452C88]"
                        for="voucher_type">@lang('lang.Voucher_Type')</label>
                    <select required
                        class="w-full  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                        name="voucher_type" id="voucher_type">
                        <option selected disabled>@lang('lang.Change_Status')</option>

                        <option
                            {{ isset($transaction) && $transaction->transaction_type == 'Payment Clearance' ? 'selected' : '' }}
                            class="capitalize">Payment Clearance</option>


                    </select>
                </div>
                {{-- <div class="w-full bg-gray mt-7 flex items-center ps-3 rounded-[6px]">
                        Balance : <span>0</span>
                    </div> --}}
                <div class="w-full">
                    <label class="text-[16px] font-semibold block text-[#452C88]"
                        for="credit">@lang('lang.Credit')</label>
                    <input type="number" min="0"
                        class="w-full mt-2 border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary h-[46px] text-[14px]"
                        name="credit" id="creditInput" placeholder="@lang('lang.Credit')"
                        value="{{ old('credit', $transaction->credit ?? '') }}" oninput="toggleInput('credit')">
                </div>

                <div class="w-full">
                    <label class="text-[16px] font-semibold block text-[#452C88]"
                        for="debit">@lang('lang.Debit')</label>
                    <input type="number" min="0"
                        class="w-full mt-2 border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary h-[46px] text-[14px]"
                        name="debit" id="debitInput" placeholder="@lang('lang.Debit')"
                        value="{{ old('debit', $transaction->debit ?? '') }}" oninput="toggleInput('debit')">
                </div>



            </div>
            <div class=" gap-5 mt-4">

                <div class="w-full">
                    <label class="text-[16px] font-semibold block  text-[#452C88]"
                        for="hint">@lang('lang.Hint')</label>
                    <input type="text"
                        class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                        name="hint" id="hint" placeholder="Enter Personal No"
                        value="{{ old('hint', $transaction->transaction_remarks ?? '') }}">
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

        <div class="overflow-x-auto">
            <table id="datatable">
                <thead class="py-1 bg-primary text-white">
                    <tr>
                        <th class="whitespace-nowrap">@lang('lang.STN')</th>
                        <th class="whitespace-nowrap">@lang('lang.Date')</th>
                        <th class="whitespace-nowrap">@lang('lang.Account')</th>
                        <th class="whitespace-nowrap">@lang('lang.Voucher_Type')</th>
                        <th class="whitespace-nowrap">@lang('lang.Credit')</th>
                        <th class="whitespace-nowrap">@lang('lang.Debit')</th>
                        <th class="whitespace-nowrap">@lang('lang.Hint')</th>
                        <th class="flex  justify-center">@lang('lang.Action')</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->date }}</td>
                            @php
                                $user = DB::table('users')
                                    ->where('id', $data->user_id)
                                    ->first();
                            @endphp
                            <td>{{ $user->name }}</td>
                            <td>{{ $data->voucher_type }}</td>
                            <td>{{ $data->credit }}</td>
                            <td>{{ $data->debit }}</td>
                            <td>{{ $data->hint }}</td>
                            <td>
                                <div class="flex gap-5 items-center justify-center">
                                    <a href="../transctionData/{{ $data->transaction_id }}">
                                        <button class="  cursor-pointer  w-[42px]"><img width="38px"
                                                src="{{ asset('images/icons/edit.svg') }}" alt="update"></button>
                                    </a>
                                    <a href="../deleteTransaction/{{ $data->transaction_id }}">
                                        <button data-modal-target="deleteData" data-modal-toggle="deleteData"
                                            class="delButton">
                                            <img width="38px" src="{{ asset('images/icons/delete.svg') }}"
                                                alt="delete" class="cursor-pointer">
                                        </button></a>
                                    <a href="{{ route('printVoucher', $data->id) }}">
                                        <div class="bg-secondary w-9 rounded-full p-1.5 text-white">
                                            <svg class="w-6 h-6 a-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </a>

                            </td>
                        </tr>
                    @endforeach



                </tbody>
            </table>
        </div>

    </div>
</div>





<script>
    function toggleInput(field) {
        const creditInput = document.getElementById('creditInput');
        const debitInput = document.getElementById('debitInput');

        if (field === 'credit' && creditInput.value) {
            debitInput.disabled = true;
            debitInput.classList.add("bg-gray");
            debitInput.value = "";
        } else if (field === 'debit' && debitInput.value) {
            creditInput.disabled = true;
            creditInput.value = "";
            creditInput.classList.add("bg-gray")
        } else {
            creditInput.disabled = false;
            debitInput.disabled = false;
            creditInput.classList.remove("bg-gray")
            debitInput.classList.remove("bg-gray")
        }
    }
</script>
@include('layouts.footer')

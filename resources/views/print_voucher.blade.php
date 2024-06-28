@include('layouts.header')
<div class="flex justify-between items-center mx-auto">
    <div class="flex gap-5 items-center">
        <img src="{{ asset('../images/your-logo.jpg') }}" width="100" alt="">
        <div>
            <h1 class="pb-3 text-red-600 text-3xl font-bold">Your Company</h1>
            <p class="ps-1">PH NO: 0303111111</p>
        </div>
    </div>
    <div>
        <div>
            <h2 class="pb-2.5 font-bold">Account Name: <span class="font-light ps-3">M-Arham
                    Waheed</span></h2>
            <h2 class="pb-2.5 font-bold">Phone No: <span class="font-light ps-3">012345678</span>
            </h2>

        </div>
    </div>
</div>
@include('layouts.footer')

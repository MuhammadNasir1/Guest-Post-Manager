@include('layouts.header')
@include('layouts.nav')
<div class="lg:mx-4  mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl ">@lang('lang.Help')</h1>
    </div>

    <div class="shadow-dark mt-3  rounded-xl py-8 px-6  bg-white ">

        <div id="accordion-flush" data-accordion="collapse"
            data-active-classes="bg-primary rounded-lg dark:bg-gray-900 text-gray-900 dark:text-white"
            data-inactive-classes="text-gray-500 dark:text-gray-400">
            <h2 id="accordion-flush-heading-1" class="bg-primary rounded-lg mt-4">
                <button type="button"
                    class="flex items-center justify-between w-full py-3 px-4  font-medium text-white  gap-3"
                    data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
                    aria-controls="accordion-flush-body-1">
                    <span>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut
                        facere officia</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-1" class="hidden bg-[#339b9668] rounded-b-lg p-2"
                aria-labelledby="accordion-flush-heading-1">
                <div class="py-5 px-2">
                    <p class="mb-2 text-gray-500">Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore
                        hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Dolore hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Dolore hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet
                        consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia
                    </p>
                    <ul class="list-disc px-6">
                        <li>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut
                            facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic
                            atque illum eos ut facere officia</li>
                        <li>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut
                            facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic
                            atque illum eos ut facere officia</li>
                    </ul>
                    <p>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut
                        facere officia Help Lorem ipsum dolor sit .</p>

                </div>
            </div>

        </div>
        <div id="accordion-flush2" data-accordion="collapse"
            data-active-classes="bg-primary rounded-lg dark:bg-gray-900 text-gray-900 dark:text-white"
            data-inactive-classes="text-gray-500 dark:text-gray-400">
            <h2 id="accordion-flush-heading-2" class="bg-primary rounded-lg mt-4">
                <button type="button"
                    class="flex items-center justify-between w-full py-3 px-4  font-medium text-white  gap-3"
                    data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
                    aria-controls="accordion-flush-body-2">
                    <span>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut
                        facere officia</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-2" class="hidden bg-[#339b9668] rounded-b-lg p-2"
                aria-labelledby="accordion-flush-heading-2">
                <div class="py-5 px-2">
                    <p class="mb-2 text-gray-500">Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore
                        hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Dolore hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Dolore hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet
                        consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia
                    </p>
                    <ul class="list-disc px-6">
                        <li>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut
                            facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic
                            atque illum eos ut facere officia</li>
                        <li>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut
                            facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic
                            atque illum eos ut facere officia</li>
                    </ul>
                    <p>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut
                        facere officia Help Lorem ipsum dolor sit .</p>

                </div>
            </div>

        </div>




        <div id="accordion-flush3" data-accordion="collapse"
            data-active-classes="bg-primary rounded-lg dark:bg-gray-900 text-gray-900 dark:text-white"
            data-inactive-classes="text-gray-500 dark:text-gray-400">
            <h2 id="accordion-flush-heading-3" class="bg-primary rounded-lg mt-4">
                <button type="button"
                    class="flex items-center justify-between w-full py-3 px-4  font-medium text-white  gap-3"
                    data-accordion-target="#accordion-flush-body-3" aria-expanded="false"
                    aria-controls="accordion-flush-body-3">
                    <span>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut
                        facere officia</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-flush-body-3" class="hidden bg-[#339b9668] rounded-b-lg p-2"
                aria-labelledby="accordion-flush-heading-3">
                <div class="py-5 px-2">
                    <p class="mb-2 text-gray-500">Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore
                        hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Dolore hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Dolore hic atque illum eos ut facere officia Help Lorem ipsum dolor sit amet
                        consectetur, adipisicing elit. Dolore hic atque illum eos ut facere officia
                    </p>
                    <ul class="list-disc px-6">
                        <li>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut
                            facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic
                            atque illum eos ut facere officia</li>
                        <li>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut
                            facere officia Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic
                            atque illum eos ut facere officia</li>
                    </ul>
                    <p>Help Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore hic atque illum eos ut
                        facere officia Help Lorem ipsum dolor sit .</p>

                </div>
            </div>

        </div>
    </div>
</div>

@include('layouts.footer')

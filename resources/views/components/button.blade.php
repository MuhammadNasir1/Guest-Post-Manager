<button {{ $attributes->merge(['class' => 'bg-' . $color . ' text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold']) }}>
    {{ $slot }}
</button>

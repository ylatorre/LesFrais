<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center py-[6.25px] px-[30px] border-none font-medium rounded-lg text-[8.75px] leading-[12.5px] block mr-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

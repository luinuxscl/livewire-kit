@if(env('APP_ENV') === 'local')
    <!-- Extra Small -->
    <span class="bg-amber-500 text-black rounded px-2 py-1 text-sm block sm:hidden w-12 align-middle font-extrabold text-center">xs</span>
  
    <!-- Small -->
    <span class="bg-amber-500 text-black rounded px-2 py-1 text-sm hidden sm:block md:hidden w-12 align-middle font-extrabold text-center">sm</span>
  
    <!-- Medium -->
    <span class="bg-amber-500 text-black rounded px-2 py-1 text-sm hidden md:block lg:hidden w-12 align-middle font-extrabold text-center">md</span>
  
    <!-- Large -->
    <span class="bg-amber-500 text-black rounded px-2 py-1 text-sm hidden lg:block xl:hidden w-12 align-middle font-extrabold text-center">lg</span>
  
    <!-- Extra Large -->
    <span class="bg-amber-500 text-black rounded px-2 py-1 text-sm hidden xl:block 2xl:hidden w-12 align-middle font-extrabold text-center">xl</span>
  
    <!-- 2XL -->
    <span class="bg-amber-500 text-black rounded px-2 py-1 text-sm hidden 2xl:block w-12 align-middle font-extrabold text-center">2xl</span>
@endif
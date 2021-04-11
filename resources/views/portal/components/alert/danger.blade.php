<!-- danger -->
<div class="bg-red-100 border-l-4 border-red-400 text-red-700 text-left p-2 mb-3 shadow-md relative" role="alert">
    <div class="flex">
        <div class="py-1">
            <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
        </div>
        <div>
            <p class="font-bold">Error</p>
            <p class="text-sm">{{ $message }}</p>
        </div>
        <!--<button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-1 mr-2 outline-none focus:outline-none"><span>×</span></button>-->
    </div>
</div>
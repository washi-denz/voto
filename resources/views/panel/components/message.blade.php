@if(session("message") && session("type"))

<div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 z-50" x-data="{'alert':true}" :class="{'hidden':!alert}" x-init="setTimeout(function(){ alert=false },2000)">
    @if(session('type') == 'error')

    <div class="px-4 py-3 leading-normal text-red-700 bg-red-200 rounded-lg" role="alert">
        <p class="font-bold">{{ session('title') }}</p>
        <p>
            {{ session('message') }}
        </p>
    </div>
    @endif

    @if(session('type') == 'success')
    <div class="px-4 py-3 leading-normal text-green-700 bg-green-200 rounded-lg" role="alert">
        <p class="font-bold">{{ session('title') }}</p>
        <p>
            {{ session('message') }}
        </p>
    </div>
    @endif

    @if(session('type') == 'info')
    <div class="px-4 py-3 leading-normal text-blue-700 bg-blue-200 rounded-lg" role="alert">
        <p class="font-bold">{{ session('title') }}</p>
        <p>
            {{ session('message') }}
        </p>
    </div>
    @endif
</div>

@endif

<div class="relative flex flex-col items-top min-h-screen bg-gray-600 sm:items-center py-4 sm:pt-0">
    <h1 class="text-5xl text-white uppercase tracking-wider py-6">Phrasele</h1>
    <div class="pt-4">
        <div>
            <div class="flex">
                @foreach($solution as $letter)
                    @if($letter == " ")
                        <div class="w-10 h-10 px-0.5 mx-1"></div>
                    @else
                    <div class="inline-flex justify-center content-center items-center font-bold uppercase border border-2 border-gray-100 w-12 h-12 mx-1 text-white text-2xl">
                        {{ "" }}
                    </div>
                    @endif
                @endforeach
            </div>
{{--            @json($store)--}}
            <input type="text" wire:keydown="handleKey($event.key)" class="opacity-0" autofocus>
        </div>
    </div>
</div>

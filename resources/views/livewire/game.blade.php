<div class="relative flex flex-col items-top min-h-screen bg-gray-600 sm:items-center py-4 sm:pt-0">
    <h1 class="text-5xl text-white uppercase tracking-wider py-6">Phrasele</h1>
    <div class="pt-4">
        <div>
            @for($i = 0; $i < $MAX_ATTEMPTS; $i++)
                <div class="flex mt-2">
                    @foreach($solution as $index => $letter)
                        @if($letter == "")
                            <div class="w-10 h-10 px-0.5 mx-1"></div>
                        @else
                            <div
                                class="inline-flex justify-center content-center items-center font-bold uppercase border border-2 border-gray-100 w-12 h-12 mx-1 text-white text-2xl {{ $this->getColor($index, $i) }}">
                                {{ $this->getKey($index, $i) }}
                            </div>
                        @endif
                    @endforeach
                </div>
            @endfor
        </div>
    </div>
    <div class="absolute inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6 dark:bg-gray-800 hidden"
         x-data="{ show: @entangle('solved') }" x-bind:class="{ 'hidden': ! show}">
        <div class="absolute right-4 top-4" x-on:click="show = !show">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" class="h-6 w-6 cursor-pointer dark:stroke-white">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div>
            <div class="text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="headlessui-dialog-title-7">Game Over!</h3>
                <div class="mt-2">
                    <div class="flex justify-center my-2">
                        <div class="items-center justify-center m-1 w-1/4 dark:text-white">
                            <div class="text-3xl font-bold">{{ $attempts }}</div>
                            <div class="text-xs">Total tries</div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6 dark:text-white">
                        <button type="button"
                                class="mt-2 w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                                tabindex="0" x-on:click="show = !show">Dismiss
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            const listener = (KeyboardEvent) => {
                if (KeyboardEvent.code === 'Enter') {
                    @this.handleAttempt()
                } else if (KeyboardEvent.code === 'Backspace') {
                    @this.handleDelete()
                } else {
                    const key = KeyboardEvent.key.toUpperCase()
                    if (key.length === 1 && key >= 'A' && key <= 'Z') {
                        @this.handleKey(key)
                    }
                }
            }
            window.addEventListener('keyup', listener)
        })
    </script>
</div>

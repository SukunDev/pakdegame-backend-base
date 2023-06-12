@if (count($items) > 0)
    <div class="max-w-full mx-auto">
        <div class="flex flex-col">
            <div id="scrollable-card" class="-mx-4 overflow-x-auto no-scrollbar">
                <div class="py-2 inline-block min-w-[54rem] w-full px-4">
                    <div class="grid grid-cols-{{ count($items) }} gap-4">
                        @foreach ($items as $item)
                            <div
                                class="relative px-4 py-4 overflow-hidden {{ array_key_exists('color', $item) ? $item['color'] : 'bg-blue-500' }} rounded-xl shadow-cardShadow">
                                <div class="relative z-10 flex flex-col space-y-2 text-white">
                                    <p class="text-4xl">{{ $item['amount'] }}</p>
                                    <p class="text-lg capitalize">{{ $item['name'] }}</p>
                                </div>
                                <div class="absolute z-0 -right-4 -bottom-6">
                                    {!! $item['slot'] !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

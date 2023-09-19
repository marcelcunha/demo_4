<div class="rounded-md border border-gray-200 bg-white">
    <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
        @isset($cardHeader)
            <div class="flex justify-between">
                <h3 class="text-base font-semibold leading-6 text-gray-900">{{ $title }}</h3>
                {{ $cardHeader }}
            </div>
            @else
            <h3 class="text-base font-semibold leading-6 text-gray-900">{{ $title }}</h3>
        @endisset
    </div>

    <div class="px-4 py-5 sm:px-6">
        {{ $slot }}
    </div>

    @isset($cardFooter)
        <div class="border-t border-gray-200 bg-white px-4 py-5 sm:px-6">
            {{ $cardFooter }}
        </div>
    @endisset
</div>

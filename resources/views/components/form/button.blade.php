@if ($link)
<a
    {{ $attributes->class([
        'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' =>
            $category === 'primary',
        'bg-white text-gray-900 ring-gray-300 hover:bg-gray-50' => $category === 'secondary',
        'bg-red-600 text-white ring-red-300 hover:bg-red-200' => $category === 'danger',

        'rounded-md  px-3 py-2 text-sm font-semibold  shadow-sm ring-1 ring-inset ',
    ]) }}>
    {{ $title }}
</a>
@else
<button
    {{ $attributes->class([
        'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' =>
            $category === 'primary',
        'bg-white text-gray-900 ring-gray-300 hover:bg-gray-50' => $category === 'secondary',
        'bg-red-600 text-white ring-red-300 hover:bg-red-200' => $category === 'danger',
        'rounded-md  px-3 py-2 text-sm font-semibold  shadow-sm ring-1 ring-inset ',
    ]) }}>
    {{ $title }}
</button>

@endif

<div {{$attributes->merge(['class' => $rootClass])}}>
    <label for="{{ $id }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label>

    <div class="relative mt-2 rounded-md shadow-sm">

        <textarea name="{{ $name }}" id="{{ $id }}"
            {{ $attributes->class([
                'ring-red-300 placeholder:text-red-300 focus:ring-red-500' => $errors->has($name),
                'block w-full rounded-md border-0 py-1.5 px-2  ring-1 ring-inset  focus:ring-2 focus:ring-inset  sm:text-sm sm:leading-6
                        disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200
                        read-only:bg-gray-50 read-only:text-gray-500 read-only:ring-gray-200',
            ]) }}
            {{ $attributes }}>
            {{ $slot }}
        </textarea>


    </div>

    @error($name)
        <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
    @enderror
</div>

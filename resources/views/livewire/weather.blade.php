<div class="flex flex-col items-center">
    @if (!empty($weather))
        <div class="text-5xl font-bold"> {{$weather['temp']}}º</div>
        <img class='mt-2 h-16 w-16' src="{{ asset("imgs/weather/{$weather['condition_slug']}.svg") }}" alt="foto_clima">
        <p class="text-sm">{{$weather['description']}}</p>
        <div class="mt-1 text-sm">{{$weather['city']}}</div>
        <p class="text-xs text-gray-400">Atualizado em: {{$weather['date'] }} {{$weather['time']}}</p>
    @endif
</div>

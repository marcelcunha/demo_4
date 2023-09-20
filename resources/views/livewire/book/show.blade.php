<x-card title='Visualizar Livro'>
    <div  class="">
        <div class="grid gap-5 md:grid-cols-3">
            <x-form.text name='title' label='Título' readonly value='{{$book->title}}'/>
            <x-form.text name='author' label='Autor(a)' readonly value='{{$book->author}}'/>
            <x-form.text name='author' label='Número de Páginas' type='number' min='1' readonly value='{{$book->pages}}'/>
                <x-form.text name='created_at' label='Data de Cadastro' readonly value="{{$book->created_at->format('d/m/Y')}}"/>
            <x-form.text-area name='description' label='Descrição' rootClass="md:col-span-3" readonly >
                {{$book->description}}
            </x-form.text-area>
        </div>
    </div>

    <x-slot name='cardFooter'>
        <div class="flex justify-end gap-5">
           <x-form.button label='Voltar' category='secondary' link href="{{route('books.index')}}"/>
        </div>
    </x-slot>
</x-card>

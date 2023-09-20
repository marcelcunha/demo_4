<div x-data='app()'>
    <x-card title='Listagem de Livros'>
        <x-slot name='cardHeader'>
            <div class="flex gap-2">
                <x-form.button label='Novo Livro' category='primary' link='{{ true }}'
                    href="{{ route('books.create') }}" />
            </div>
        </x-slot>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">
                                    Título
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Autor(a)
                                </th>
                                <th scope="col"
                                    class="w-20 px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Nº Páginas</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Data de Cadastro</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Ações</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr class="divide-y divide-gray-300">
                                <th scope="col" class="">
                                    <input type="text" wire:model.live.debounce='title' placeholder="Título">
                                </th>
                                <th scope="col" class="">
                                    <input type="text" wire:model.live.debounce='author' placeholder="Autor(a)">
                                </th>
                                <th scope="col" class="px-4 py-2">
                                    <div class="flex w-24 flex-col gap-2">
                                        <input type="number" wire:model.live.debounce='minPages' placeholder="Min">
                                        <input type="number" wire:model.live.debounce='maxPages' placeholder="Max">
                                    </div>
                                </th>
                                <th scope="col" class="">
                                    <div class="flex flex-col gap-2 w-44">

                                        <input type="date" wire:model.live.debounce='minDate'>

                                        <input type="date" wire:model.live.debounce='maxDate'>
                                    </div>
                                </th>

                                <th>
                                    <x-form.button category='secondary' label="Limpar Filtros"
                                        wire:click='resetFilters'>


                                    </x-form.button>
                                </th>


                            </tr>
                            @foreach ($books as $book)
                                <tr class="even:bg-gray-50">
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                                        {{ $book->title }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $book->author }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $book->pages }}
                                    </td>

                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $book->created_at->format('d/m/Y') }}</td>
                                    <td
                                        class="flex gap-0.5 whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                        <x-form.button title='Visualizar' category='secondary' link
                                            href="{{ route('books.show', $book->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>

                                        </x-form.button>
                                        <x-form.button title="Editar" category='secondary' link
                                            href="{{ route('books.edit', $book->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>

                                        </x-form.button>
                                        <x-form.button title="Remover" category='danger' {{-- wire:click='remove({{ $book->id }})' --}}
                                            x-on:click='openModal({{ $book->id }})'>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>


                                        </x-form.button>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <x-slot name='cardFooter'>
            <div class="flex justify-between">{{ $books->links() }}</div>
        </x-slot>
    </x-card>

    <x-alpine-modal title='Remover Livro'>

        <div class="mt-10">
            <div class="flex flex-col items-center justify-center">
                <svg class="h-20 w-20 text-red-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <p class="mt-10 text-xl">Tem certeza que deseja remover o Livro?</p>
                <p class="mt-5 text-lg text-red-700">Essa ação não poderá ser desfeita.</p>
            </div>

            <div class="my-5 border-t">

                <div class="mt-5 flex justify-end gap-5">
                    <x-form.button label='Remover' category='danger'
                        @click="$dispatch('removeBook', {book: id}); id = null" />
                    <x-form.button label='Não' category='secondary' @click="closeModal" />
                </div>
            </div>
        </div>


    </x-alpine-modal>
</div>

@section('js')
    <script>
        JSON.stringfy
        const app = () => {
            return {
                showModal: false,
                id: null,
                openModal(id) {
                    this.showModal = true;
                    this.id = id;
                },
                closeModal() {
                    this.showModal = false;
                },
            }
        }
    </script>
@endsection

<div class="container px-10 py-20">
    <x-card title='Alterar Livro'>
        <form action="" class="">
            <div class="grid gap-5 md:grid-cols-3">
                <x-form.text name='title' label='Título' wire:model='title' />
                <x-form.text name='author' label='Autor(a)' wire:model='author' />
                <x-form.text name='pages' label='Número de Páginas' type='number' min='1' wire:model='pages' />
                <x-form.text-area name='description' label='Descrição' rootClass="md:col-span-3" wire:model='description' />
            </div>
        </form>

        <x-slot name='cardFooter'>
            <div class="flex justify-end gap-5">
               <x-form.button label='Salvar' category='primary' wire:click='save'/>
               <x-form.button label='Cancelar' category='secondary' link href="{{route('books.index')}}"/>
            </div>
        </x-slot>
    </x-card>
</div>

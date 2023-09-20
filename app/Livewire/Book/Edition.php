<?php

namespace App\Livewire\Book;

use App\Models\Book;
use App\Services\BookService;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Component;

class Edition extends Component
{
    public Book $book;

    public string $title = '';

    public string $author = '';

    public ?string $description = null;

    public ?int $pages = null;

    public function mount(Book $book): void
    {
        $this->book = $book;

        $this->title = $book->title;
        $this->author = $book->author;
        $this->pages = $book->pages;
        $this->description = $book->description;
    }

    public function render(): View
    {
        return view('livewire.book.edition');
    }

    public function save(BookService $service): \Illuminate\Http\RedirectResponse|Redirector
    {
        $this->validate();
        try {
            $service->edit(
                $this->book,
                $this->title,
                $this->author,
                $this->pages,
                $this->description
            );

            $key = 'success';
            $message = 'Livro alterado com sucesso!';
        } catch (\Exception $e) {
            report($e);

            $key = 'error';
            $message = 'Erro ao editar um livro!';
        }

        return redirect()->route('books.index')->with($key, $message);
    }

    /**
     * @return array<string, array<int, string|ValidationRule>>
     */
    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100', ValidationRule::unique('books')->ignore($this->book->id)],
            'author' => ['required', 'string', 'max:100'],
            'pages' => ['required', 'integer'],
            'description' => ['nullable', 'string', 'max:400'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function validationAttributes(): array
    {
        return [
            'title' => 'Título',
            'author' => 'Autor(a)',
            'pages' => 'Número de Páginas',
            'description' => 'Descrição',
        ];
    }
}

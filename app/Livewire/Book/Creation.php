<?php

namespace App\Livewire\Book;

use App\Services\BookService;
use Illuminate\Routing\Redirector;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Creation extends Component
{
    #[Rule(['required', 'unique:books', 'string', 'max:100'])]
    public string $title = '';

    #[Rule(['required', 'string', 'max:100'])]
    public string $author = '';

    #[Rule(['nullable', 'string', 'max:400'])]
    public string $description = '';

    #[Rule(['required', 'integer'])]
    public ?int $pages = null;

    public function render(): \Illuminate\View\View
    {
        return view('livewire.book.creation');
    }

    public function save(BookService $service): \Illuminate\Http\RedirectResponse|Redirector
    {
        $this->validate();
        try {
            $service->add(
                $this->title,
                $this->author,
                $this->pages,
                $this->description
            );

            $key = 'success';
            $message = 'Livro criado com sucesso!';
        } catch (\Exception $e) {
            report($e);

            $key = 'error';
            $message = 'Erro ao criar livro!';
        }

        return redirect()->route('books.index')->with($key, $message);
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

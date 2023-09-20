<?php

namespace App\Livewire\Book;

use App\Models\Book;
use App\Services\BookService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?string $title = null;

    public ?string $author = null;

    public ?int $minPages = null;

    public ?int $maxPages = null;

    public ?string $minDate = null;

    public ?string $maxDate = null;

    public bool $openModal = false;

    /** @var array<string,string> */
    protected $listeners = [
        'removeBook' => 'remove',
    ];

    public function updated(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $books = Book::query()
            ->when($this->title, fn ($query, $title) => $query->where('title', 'like', "%{$title}%"))
            ->when($this->author, fn ($query, $author) => $query->where('author', 'like', "%{$author}%"))
            ->when($this->minPages, fn ($query, $minPages) => $query->where('pages', '>=', $minPages))
            ->when($this->maxPages, fn ($query, $maxPages) => $query->where('pages', '<=', $maxPages))
            ->when($this->minDate, fn ($query, $minDate) => $query->where('created_at', '>=', $minDate))
            ->when($this->maxDate, fn ($query, $maxDate) => $query->where('created_at', '<=', $maxDate))
            ->paginate(8);

        return view('livewire.book.index', [
            'books' => $books,
        ]);
    }

    public function remove(Book $book, BookService $service): Redirector|RedirectResponse
    {
        try {
            $service->delete($book);

            $key = 'success';
            $message = 'Livro removido com sucesso!';
        } catch (\Exception $e) {
            report($e);

            $key = 'error';
            $message = 'Erro ao remover livro!';
        }

        return redirect()->route('books.index')->with($key, $message);
    }

    public function resetFilters(): void
    {
        $this->reset();
    }
}

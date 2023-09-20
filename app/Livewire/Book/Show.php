<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Show extends Component
{
    public Book $book;

    public function render(): View
    {
        return view('livewire.book.show');
    }
}

<?php

use App\Livewire\Book\Index;
use App\Models\Book;
use App\Models\User;
use Livewire\Livewire;

test('book list cant be showed if not authenticated', function () {
    $response = $this->get(route('books.index'));

    $response->assertStatus(302)->assertRedirect(route('login'));
});

it('should display book list if authenticated', function () {

    $response = $this->actingAs(User::factory()->create())
        ->get(route('books.index'));

    $response->assertStatus(200)->assertSee('Listagem de Livros');
});

it('should delete book if call remove method', function(){
    $book = Book::factory()->create();

   Livewire::actingAs(User::factory()->create())
        ->test(Index::class)
        ->call('remove', $book->id)
        ->assertRedirect(route('books.index'));

    $this->assertDatabaseMissing('books', [
        'id' => $book->id,
    ]);
});

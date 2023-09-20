<?php

use App\Livewire\Book\Edition;
use App\Models\Book;
use App\Models\User;
use Livewire\Livewire;

it('should not display book update if not authenticated', function () {

    $response = $this->get(route('books.edit', 1));

    $response->assertStatus(302)->assertRedirect(route('login'));
});

it('should display book update if authenticated', function () {
    Book::factory()->create(['id' => 1]);
    $response = $this->actingAs(User::factory()->create())
        ->get(route('books.edit', 1));

    $response->assertStatus(200)->assertSee('Alterar Livro');
});

it(
    'should not display book update if book not exists',
    function () {

        $response = $this->actingAs(User::factory()->create())
            ->get(route('books.edit', 1));

        $response->assertStatus(404);
    }
);

it('should update book if all data is valid', function () {

    $this->actingAs(User::factory()->create());
    $book = Book::factory()->create(['id' => 1]);

    Livewire::test(Edition::class, ['book' => $book])
        ->set('title', 'Livro de teste')
        ->set('author', 'Autor de teste')
        ->set('pages', 10)
        ->call('save')
        ->assertRedirect(route('books.index'));

    $this->assertTrue(\App\Models\Book::where('title', 'Livro de teste')
        ->where('author', 'Autor de teste')->exists());
});

it('should not update book if fields data is empty', function () {

    $this->actingAs(User::factory()->create());
    $book = Book::factory()->create(['id' => 1]);

    Livewire::test(Edition::class, ['book' => $book])
        ->set('title', '')
        ->set('author', '')
        ->set('pages', null)
        ->call('save')
        ->assertHasErrors(['title', 'author', 'pages']);
});

it('should not update book if title duplicated', function () {
    Book::factory()->create(['id' => 1, 'title' => 'Livro de teste']);

    $this->actingAs(User::factory()->create());
    $book = Book::factory()->create(['id' => 2]);

    Livewire::test(Edition::class, ['book' => $book])
        ->set('title', 'Livro de teste')
        ->set('author', 'Autor de teste')
        ->set('pages', 120)
        ->call('save')
        ->assertHasErrors(['title' => 'unique']);
});

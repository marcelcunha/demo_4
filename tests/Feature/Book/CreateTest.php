<?php

use App\Livewire\Book\Creation;
use App\Models\Book;
use App\Models\User;
use Livewire\Livewire;

it('should not display book register if not authenticated', function () {

    $response = $this->get(route('books.create'));

    $response->assertStatus(302)->assertRedirect(route('login'));
});

it('should display book register if authenticated', function () {

    $response = $this->actingAs(User::factory()->create())
        ->get(route('books.create'));

    $response->assertStatus(200)->assertSee('Novo Livro');
});

it('should register book if all data is valid', function () {

    $this->actingAs(User::factory()->create());
    Livewire::test(Creation::class)
        ->set('title', 'Livro de teste')
        ->set('author', 'Autor de teste')
        ->set('description', 'Descrição de teste')
        ->set('pages', 10)
        ->call('save')
        ->assertRedirect(route('books.index'));

    $this->assertTrue(\App\Models\Book::where('title', 'Livro de teste')
        ->where('author', 'Autor de teste')->exists());
});

it('should not register book if fields data is empty', function () {

    $this->actingAs(User::factory()->create());
    Livewire::test(Creation::class)
        ->set('title', '')
        ->set('author', '')
        ->set('description', 'Descrição de teste')
        ->set('pages', null)
        ->call('save')
        ->assertHasErrors(['title', 'author', 'pages']);
});

it('should not register book if title duplicated', function () {
    Book::factory()->create(['title' => 'Livro de teste']);

    $this->actingAs(User::factory()->create());

    Livewire::test(Creation::class)
        ->set('title', 'Livro de teste')
        ->set('author', 'Autor de teste')
        ->set('description', 'Descrição de teste')
        ->set('pages', 120)
        ->call('save')
        ->assertHasErrors(['title' => 'unique']);
});

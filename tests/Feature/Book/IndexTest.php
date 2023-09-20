<?php

use App\Models\User;

test('book list cant be showed if not authenticated', function () {
    $response = $this->get(route('books.index'));

    $response->assertStatus(302)->assertRedirect(route('login'));
});

it('should display book list if authenticated', function () {

    $response = $this->actingAs(User::factory()->create())
        ->get(route('books.index'));

    $response->assertStatus(200)->assertSee('Listagem de Livros');
});
